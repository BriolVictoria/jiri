<?php

use App\Models\Jiri;
use App\Models\User;
use function Pest\Laravel\actingAs;

it(
    'can display the login form',
    function () {

        //action
        $response = $this->get('/login'); //rediriger vers login

        //assert
        $response->assertSee('Identifiez-vous');
        $response->assertSeeInOrder(['<form', 'Email', 'Mot de passe', '<button', 'Identifiez-vous'], true);

    }
);

it(
    'verifies if we are redirected to the dashboard after a successful request',
    function () {

        $password = '123456789';
        $user = User::factory()->create([
            'name' => 'Ambre Briol',
            'email' => 'ambre.briol@gmail.com',
            'password' => Hash::make($password)
        ]);

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('jiris.index'));
    }
);

it(
    'verifies if a guest can‘t access to the jiris.index and the guest is redirect to the login page',
    function () {

        $response = $this->get(route('jiris.index'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));


    }
);

it(
    'can display the register form',
    function () {

        //action
        $response = $this->get('/register'); //rediriger vers login

        //assert
        $response->assertSee('Créer un compte');
        $response->assertSeeInOrder(['<form', 'Nom', 'Email', 'Mot de passe', '<button', 'Créer le compte'], true);

    }
);

it(
    'verifies if the jiris on the dashboard page are associated to the current user',
    function () {

        $user = User::factory()
            ->has(Jiri::factory()->count(3))
            ->create();

        $other_user = User::factory()
            ->has(Jiri::factory()->count(4))
            ->create();

        actingAs($user);

        $response = $this->get(route('jiris.index'));

        foreach ($user->jiris as $jiri) {
            $response->assertSee($jiri->name);
        }

        foreach ($other_user->jiris as $jiri) {
            $response->assertDontSee($jiri->name);
        }
    }
);

