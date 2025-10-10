<?php

use App\Models\Jiri;
use App\Models\User;
use function Pest\Laravel\actingAs;

it(
    'can display the login form',
    function () {
        //Act
        $response = $this->get('/login'); //rediriger vers login

        //Assert
        $response->assertSee('Identifiez-vous');
        $response->assertSeeInOrder(['<form', 'Email', 'Mot de passe', '<button', 'Identifiez-vous'], true);

    }
);

it(
    'verifies if we are redirected to the dashboard after a successful request',
    function () {
        //Arrange
        $password = '123456789';
        $user = User::factory()->create([
            'name' => 'Ambre Briol',
            'email' => 'ambre.briol@gmail.com',
            'password' => Hash::make($password)
        ]);

        //Act
        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('jiris.index'));
    }
);

it(
    'verifies if a guest can‘t access to the jiris.index and the guest is redirect to the login page',
    function () {
        //Act
        $response = $this->get(route('jiris.index'));

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));


    }
);

it(
    'can display the register form',
    function () {
        //Act
        $response = $this->get('/register'); //rediriger vers login

        //Assert
        $response->assertSee('Créer un compte');
        $response->assertSeeInOrder(['<form', 'Nom', 'Email', 'Mot de passe', '<button', 'Créer le compte'], true);

    }
);

it(
    'verifies if the jiris on the dashboard page are associated to the current user',
    function () {
        //Arrange
        $user = User::factory()
            ->hasJiris(3)
            ->create();

        $other_user = User::factory()
            ->hasJiris(4)
            ->create();

        actingAs($user);

        //Act
        $response = $this->get(route('jiris.index'));

        $response->assertSee($user->jiris->pluck('name')->toArray());
        $response->assertDontSee($other_user->jiris->pluck('name')->toArray());

    }
);

it(
    'verifies if the jiris.edit exist and if she has a form',
    function () {
        $user = User::factory()->create();

        $jiri = Jiri::factory()->create();

        actingAs($user);

        $response = $this->get(route('jiris.edit',$jiri->id));

        $response->assertStatus(200);
        $response->assertViewIs('jiris.edit');
        $response->assertSee('Modifiez le jiri');
    }
);
