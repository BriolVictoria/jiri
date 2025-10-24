<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Jobs\ProcessUploadContactAvatar;
use App\Models\Contact;
use App\Models\Jiri;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    use AuthorizesRequests;

    public function store(StoreContactRequest $request)
    {

        $validatedData = $request->validated();

        if ($validatedData['avatar']) {
            $new_original_file_name = uniqid() . '.' . config('contactavatars.image_type');
            $full_path_to_original = Storage::putFileAs(
                config('contactavatars.original_path'),
                $validatedData['avatar'],
                $new_original_file_name);

            if ($full_path_to_original) {
                $validatedData['avatar'] = $new_original_file_name;

                ProcessUploadContactAvatar::dispatch($full_path_to_original, $new_original_file_name);
            } else {
                $validatedData['avatar'] = '';
            }
        }

        $contact = auth()->user()->contacts()->create($validatedData);

        return redirect(route('contacts.show', compact('contact')));
    }

    public function index()
    {
        $contacts = request()->user()->contacts()->orderBy('name')->paginate(6);
        $contacts = Str::lower($contacts);


        return view('contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $jiris = Jiri::all();
        return view('contacts.show', compact('contact', 'jiris'));
    }

    public function create()
    {
        $jiris = Jiri::all();
        return view('contacts.create', compact('jiris'));
    }

    public function edit(Contact $contact)
    {
        $jiris = Jiri::all();
        return view('contacts.edit', compact('contact', 'jiris'));
    }

    public function update(Contact $contact, StoreContactRequest $request)
    {
        //$this->authorize('update', $contact);

        $validatedData = $request->validated();

        $contact->upsert(
            [
                [
                    'id' => $contact->id,
                    'user_id' => auth()->user()->id,
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                ],
            ],
            'id',
            ['name', 'email'],
        );

        return redirect(route('contacts.show', $contact->id));
    }
}
