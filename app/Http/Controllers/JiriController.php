<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Events\JiriCreatedEvent;
use App\Mail\JiriCreatedMail;
use App\Models\Contact;
use App\Models\Homework;
use App\Models\Jiri;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
                    $homeworks = Homework::where('jiri_id' , '=', $jiri->id)->pluck('id')->toArray();
                    $correct_contact = Contact::where('contacts.id', '=', $key)->first();

                    $correct_contact->homeworks()->attach($homeworks);
                }
            }
        }


        event(new JiriCreatedEvent($jiri));
        //Mail::to($request->user())->queue(new JiriCreatedMail($jiri));

        return redirect(route('jiris.index'));
    }

    public function index()
    {
        //$jiris = Auth::user()->jiris;

        $jiris = Jiri::all();
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

    public function update(Jiri $jiri)
    {
        $this->authorize('update', $jiri);

        return 'toto';
    }
}
