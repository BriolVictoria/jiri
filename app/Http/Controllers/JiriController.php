<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Events\JiriCreatedEvent;
use App\Http\Requests\StoreJiriRequest;
use App\Models\Contact;
use App\Models\Homework;
use App\Models\Jiri;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JiriController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request): RedirectResponse
    {
        $validated_data = $request->validate([
            'name' => 'required',
            'date' => 'required|date',
            'description' => 'nullable',
            'contacts.*' => 'nullable|array',
            'projects.*' => 'nullable',
        ]);

        $jiri = Auth::user()->jiris()->create($validated_data);

        if (!empty($validated_data['projects'])) {
            $jiri->projects()->attach($validated_data['projects']);
        }

        if (!empty($validated_data['contacts'])) {
            foreach ($validated_data['contacts'] as $key => $contact) {
                $jiri->contacts()->attach($key, ['role' => $contact['role']]);

                if ($contact['role'] === ContactRoles::Evaluated->value) {
                    $homeworks = Homework::where('jiri_id', '=', $jiri->id)->pluck('id')->toArray();
                    $correct_contact = Contact::where('contacts.id', '=', $key)->first();

                    $correct_contact->homeworks()->attach($homeworks);
                }
            }
        }

        event(new JiriCreatedEvent($jiri));

        return redirect(route('jiris.show', compact('jiri')));

    }

    public function index()
    {
        //$jiris = Auth::user()->jiris;

        $jiris = Jiri::with(['attendances', 'projects'])->where('user_id', auth()->user()->id)->orderBy('name')->paginate(6);

        foreach ($jiris as $jiri){
            $jiri->name = Str::lower($jiri->name);
        }

        return view('jiris.index', compact('jiris'));
    }

    public function show(Jiri $jiri)
    {
        return view('jiris.show', compact('jiri'));
    }

    public function create()
    {
        $contacts = Contact::all();
        $projects = Project::all();
        return view('jiris.create', compact('contacts', 'projects'));
    }

    public function edit(Jiri $jiri)
    {
        $contacts = Contact::all();
        $projects = Project::all();
        return view('jiris.edit', compact('jiri', 'contacts', 'projects'));
    }

    public function update(StoreJiriRequest $request, Jiri $jiri): RedirectResponse
    {
        //$this->authorize('update', $jiri);

        /****** Validation des données ******/
        $validated_data = $request->validated();

        /****** Mise à jour des données du Jiri ******/
        $jiri->upsert(
            [
                [
                    'id' => $jiri->id,
                    'user_id' => auth()->user()->id,
                    'name' => $validated_data['name'],
                    'date' => $validated_data['date'],
                    'description' => $validated_data['description'],
                ],
            ],
            'id',
            ['name', 'date', 'description']);

        /****** Récupération des anciens contacts pour mettre à jour les implémentations ******/
        $old_contacts_ids = $jiri->contacts()->pluck('contact_id')->toArray();

        /****** Mise à jour des homeworks ******/
        if (!empty($validated_data['projects'])) {
            $jiri->projects()->sync($validated_data['projects']);
        } else {
            $jiri->projects()->detach();
        }

        /****** Mise à jour des attendances ******/
        if (!empty($validated_data['contacts'])) {
            $jiri->contacts()->sync($validated_data['contacts']);
        } else {
            $jiri->contacts()->detach();
        }

        /****** Implementation : Suppression d'un contact du jiri ******/
        $new_contacts_ids = array_keys($validated_data['contacts'] ?? []);
        $contacts_to_remove = array_diff($old_contacts_ids, $new_contacts_ids);

        if (!empty($contacts_to_remove)) {
            foreach ($contacts_to_remove as $contact_to_remove) {
                if ($contact = Contact::where('id', '=', $contact_to_remove)->first()) {
                    $contact->homeworks()->detach();
                }
            }
        }

        /****** Implementation : Changement de rôle d'un contact ******/
        if (!empty($validated_data['contacts'])) {
            foreach ($validated_data['contacts'] as $id => $contact) {
                $homeworks_id = $jiri->homeworks()->pluck('id');
                $correct_contact = $jiri->contacts->where('id', '=', $id)->first();

                if ($contact['role'] === ContactRoles::Evaluated->value) {
                    $correct_contact->homeworks()->sync($homeworks_id);
                } else {
                    $correct_contact->homeworks()->detach();
                }
            }
        }

        return redirect(route('jiris.show', $jiri->id));
    }
}
