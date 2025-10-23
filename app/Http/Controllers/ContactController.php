<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Jobs\ProcessUploadContactAvatar;
use App\Models\Contact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

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
        $contacts = Contact::all();

        return view('contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
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
