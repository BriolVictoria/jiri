<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ContactController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request)
    {

        $validatedData = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'avatar' => 'nullable|image'
        ]);

        if ($request->hasFile('avatar')) {
            $image = Image::read($validatedData['avatar'])
                ->cover(300, 300)
                ->toJpeg(80);
            $file_name = 'contact_' . uniqid() . '_300x300.jpg';
            $path = "contacts/$file_name";

            Storage::disk('public')->put($path, $image->toString());

            $validatedData['avatar'] = $path;
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

    public function update(Contact $contact)
    {
        $this->authorize('update', $contact);

        return 'toto';
    }
}
