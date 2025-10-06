<?php

use App\Models\Contact;

it(
    'create a Contact and redirect to the contact index',
    function () {
        // Arrange
        $contact = [
            'name' => 'Amandine Briol',
            'email' => 'Amandine.briol@student.hepl.be',
        ];

        // Act
        $response = $this->post('/contacts', $contact);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('/contacts');
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
        $response = $this->get('/contacts/'.$contact->id);

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('contacts.show');
        $response->assertSee('Récapitulatif des contacts : '.$contact->name);
    });

it(
    'check the validation',
    function () {

        $contact = [
            'name' => '',
            'email' => '',
        ];

        $response = $this->post('/contacts', $contact);

        $response->assertInvalid('name');

    });
