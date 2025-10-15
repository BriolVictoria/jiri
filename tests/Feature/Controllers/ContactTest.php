<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use function Pest\Laravel\actingAs;

it(
    'create a Contact and redirect to the contact index',
    function () {
        // Arrange
        $user = User::factory()->create();

        actingAs($user);

        \Illuminate\Support\Facades\Storage::fake('public');

        $avatar = UploadedFile::fake()->image('photo.jpg');

        $contact = [
            'name' => 'Amandine Briol',
            'email' => 'Amandine.briol@student.hepl.be',
            'avatar' => $avatar,
        ];

        // Act
        $response = $this->post(route('contacts.store'), $contact);

        // Assert
        $response->assertStatus(302);
        $contact = Contact::first();
        \Illuminate\Support\Facades\Storage::disk('public')->assertExists($contact->avatar);
        $response->assertRedirect(route('contacts.show', compact('contact')));
        \Pest\Laravel\assertDatabaseHas('contacts', ['name' => 'Amandine Briol']);
    }

);

it(
    'display a complete list of contacts on the contact index page',
    function () {
        // Arrange
        $contacts = Contact::factory(4)->create();

        // Act
        $response = $this->get('/contacts');

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('contacts.index');
        $response->assertSee('Liste des contacts');

        foreach ($contacts as $contact) {
            $response->assertSee($contact['name'], ['email']);
        }
    }
);

it(
    'verify if the link in contact is the same of the contact dashboard',
    function () {
        // Arrange
        $contact = Contact::factory()->create();

        // Act
        $response = $this->get('/contacts/' . $contact->id);

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('contacts.show');
        $response->assertSee('Récapitulatif des contacts : ' . $contact->name);
    });

it(
    'check the validation',
    function () {
        //Arrange
        $contact = [
            'name' => '',
            'email' => '',
        ];

        //Act
        $response = $this->post('/contacts', $contact);

        //Assert
        $response->assertInvalid('name');

    });

it(
    'verifies if the contacts.show exist',
    function () {
        $user = User::factory()->create();

        $contact = Contact::factory()->for($user)->create();

        actingAs($user);

        $response = $this->get(route('contacts.show',$contact->id));

        $response->assertStatus(200);
        $response->assertViewIs('contacts.show');
        $response->assertSee($contact->name);
    }
);

it(
    'verifies if the contacts.edit exist and if she has a form',
    function () {
        $user = User::factory()->create();

        $contact = Contact::factory()->for($user)->create();

        actingAs($user);

        $response = $this->get(route('contacts.edit',$contact->id));

        $response->assertStatus(200);
        $response->assertViewIs('contacts.edit');
        $response->assertSee('Modifiez le contact');
    }
);
