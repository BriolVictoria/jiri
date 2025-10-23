<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it(
    'create a Contact and redirect to the contact index',
    function () {
        // Arrange
        $user = User::factory()->create();

        actingAs($user);

        Storage::fake('public');

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
        Storage::disk('public')->assertExists($contact->avatar);

        $image = Image::read(Storage::disk('public')->get($contact->avatar));

        expect($image->width())
            ->toBeLessThanOrEqual(300)
            ->and($image->height())
            ->toBeLessThanOrEqual(300);


        $response->assertRedirect(route('contacts.show', compact('contact')));
        \Pest\Laravel\assertDatabaseHas('contacts', ['name' => 'Amandine Briol']);
    }
);

it(
    'display a complete list of contacts on the contact index page',
    function () {
        // Arrange
        $user = User::factory()->create();
        $contacts = Contact::factory(4)->for($user)->create();

        actingAs($user);

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
        $user = User::factory()->create();
        $contact = Contact::factory()->for($user)->create();

        actingAs($user);

        // Act
        $response = $this->get('/contacts/' . $contact->id);

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('contacts.show');
        $response->assertSee('Récapitulatif du contact');
    });

it(
    'check the validation',
    function () {
        //Arrange
        $user = User::factory()->create();
        actingAs($user);
        $contact = [
            'name' => '',
            'email' => '',
        ];

        //Act
        $response = $this->post('/contacts', $contact);

        //Assert
        $response->assertInvalid('name');
        $response->assertInvalid('email');

    });

it(
    'verifies if the contacts.show exist',
    function () {
        $user = User::factory()->create();

        $contact = Contact::factory()->for($user)->create();

        actingAs($user);

        $response = $this->get(route('contacts.show', $contact->id));

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

        $response = $this->get(route('contacts.edit', $contact->id));

        $response->assertStatus(200);
        $response->assertViewIs('contacts.edit');
        $response->assertSee('Modifiez le contact');
    }
);

it(
    'verifies if the user connected can‘t modify an other contact',
    function () {

        $user = User::factory()->create();
        actingAs($user);

        $contact = Contact::factory()->for($user)->create();

        $response = $this->patch(route('contacts.update', $contact));

        $response->assertStatus(403);

    }
);

it(
    'verifies if a project is correctly modified in the database',
    function () {
        $user = User::factory()->create();
        actingAs($user);

        $contact = Contact::factory()->for($user)->create();

        $modify_data = [
            'name' => 'ili',
            'email' => 'i@l.be',
        ];

        $response = $this->patch(route('contacts.update', $contact->id), $modify_data);
        $response->assertStatus(302);
        $response->assertRedirect(route('contacts.show', $contact->id));

        assertDatabaseMissing('contacts', [
           'name' => $contact['name'],
           'email' => $contact['email'],
        ]);

        assertDatabaseHas('contacts', [
           'name' => $modify_data['name'],
           'email' => $modify_data['email'],
        ]);
    }
);
