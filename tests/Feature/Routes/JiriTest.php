<?php

use App\Models\Jiri;

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

it(
    'redirects to the jiri index route after the successful creation of a jiri',
    function () {
        // Arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()->raw();

        // Act
        $response = post(route('jiris.store'), $jiri);   // ou post() mais importer la fonction

        // Assert
        $response->assertStatus(302); // redirection vers une autre page
        $response->assertRedirect('/jiris');

    }
);

it(
    'display a complete list of jiris on the jiri index page',
    function () {
        // Arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiris = Jiri::factory(4)
            ->for($user)
            ->create();

        // Act
        $response = $this->get('/jiris');

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('jiris.index');
        $response->assertSee('Listes des jiris');

        foreach ($jiris as $jiri) {
            $response->assertSee($jiri['name']);
        }
    }
);

it(
    'verify if the link in jiri is the same of the jiri dashboard',
    function () {
        // Arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()
            ->for($user)
            ->create();

        // Act
        $response = $this->get('/jiris/' . $jiri->id);

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('jiris.show');
        $response->assertSee('Récapitulatif du jiri');
    }
);

it(
    'check the validation',
    function () {
        //Arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()->make([
            'name' => '',
            'date' => \Carbon\Carbon::now(),
        ])->toArray();

        //Act
        $response = $this->post('/jiris', $jiri);

        //Assert
        $response->assertInvalid('name');
    }
);
