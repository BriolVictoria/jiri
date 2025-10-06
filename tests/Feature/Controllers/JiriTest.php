<?php

use App\Enums\ContactRoles;
use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Homework;
use App\Models\Implementation;
use App\Models\Jiri;
use App\Models\Project;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it(
    'create successfully a jiri from the data provided by the request',
    function () {
        // Arrange
        $jiri = Jiri::factory()->raw();

        // Act
        $response = $this->post('/jiris', $jiri);    // ou post() mais importer la fonction

        // Assert
        \Pest\Laravel\assertDatabaseHas('jiris', ['name' => $jiri['name']]);

    }
);

it(
    'fails to create a new jiri in database when the name is missing in the request',
    function () {

        $jiri = Jiri::factory()
            ->withoutName()
            ->raw();

        $response = post(route('jiris.store'), $jiri);
        //expect($response)->toThrow(\Illuminate\Database\QueryException::class);

        $response->assertInvalid('name');

        \Pest\Laravel\assertDatabaseEmpty('jiris');

    }
);

it(
    'fails to create a new jiri in database when the date is missing in the request',
    function () {

        $jiri = Jiri::factory()
            ->withoutDate()
            ->raw();

        $response = post(route('jiris.store'), $jiri);
        //expect($response)->toThrow(\Illuminate\Database\QueryException::class);

        $response->assertInvalid('date');

        \Pest\Laravel\assertDatabaseEmpty('jiris');

    }
);

it(
    'fails to create a new jiri in database when the date has the wrong format in the request',
    function () {

        $jiri = Jiri::factory()
            ->withInvalidDate()
            ->raw();

        $response = post(route('jiris.store'), $jiri);
        //expect($response)->toThrow(\Illuminate\Database\QueryException::class);

        $response->assertInvalid('date');

        \Pest\Laravel\assertDatabaseEmpty('jiris');

    }
);

it(
    'display a complete list of jiris on the jiri index page',
    function () {
        // Arrange
        $jiris = Jiri::factory(4)->create();

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
        $jiri = Jiri::factory()->create();

        // Act
        $response = $this->get('/jiris/' . $jiri->id);

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('jiris.show');
        $response->assertSee('Récapitulatif du jiri : ' . $jiri->name);
    }
);

it(
    'verifies if jiri data is correctly inserted in the DB when you create a Jiri with projects',
    function () {
        $jiri = Jiri::factory()->raw();

        $projects = Project::factory()
            ->count(3)
            ->create()
            ->pluck('id', 'id') // Pour récupérer une colonne spécifique dans un tableau et lui donner une valeur pour reconstruire un nouveau tableau
            ->toArray();

        // Project::factory()->count(3)->create();
        // $projects = Project::all()->pluck('id', 'id')->toArray();


        $form_data = array_merge(
            $jiri, [
                'projects' => $projects
            ]
        );

        $response = $this->post(route('jiris.store'), $form_data);
        $response->assertStatus(302); //status de redirection

        /*\Pest\Laravel\assertDatabaseCount('jiri', '1'); // pareil que celui en dessous*/

        expect(Jiri::all()->count())->toBe(1)
            ->and(Project::all()->count())->toBe(3)
            ->and(Homework::all()->count())->toBe(3);

    }
);

it(
    'verifies if jiri data is correctly inserted in the DB when you create a Jiri with contacts',
    function () {

        $jiri = Jiri::factory()->raw();

        $contacts = Contact::factory()
            ->count(4)
            ->create()
            ->pluck('id', 'id')
            ->toArray();

        $form_data = array_merge($jiri, [
            'contacts' => $contacts
        ]);

        $available_roles = [
            1 => ContactRoles::Evaluators->value,
            2 => ContactRoles::Evaluated->value,
        ];

        foreach ($contacts as $key => $contact) {
            $form_data['contacts'][$key] = ['role' => $available_roles[random_int(1, 2)]];
        }

        $response = $this->post(route('jiris.store'), $form_data);

        $response->assertStatus(302);
        expect(Jiri::all()->count())->toBe(1)
            ->and(Contact::all()->count())->toBe(4)
            ->and(Attendance::all()->count())->toBe(4);
    }
);

it('verifies if jiri data is correctly inserted in the DB when you create a Jiri with contacts and projects',
    function () {

        $jiri = Jiri::factory()->raw();

        $contacts = Contact::factory()
            ->count(4)
            ->create()
            ->pluck('id', 'id')
            ->toArray();

        $projects = Project::factory()
            ->count(3)
            ->create()
            ->pluck('id', 'id')
            ->toArray();


        $form_data = array_merge($jiri, [
            'contacts' => $contacts,
            'projects' => $projects,
        ]);

        $available_roles = [
            1 => ContactRoles::Evaluated->value,
            2 => ContactRoles::Evaluated->value
        ];

        foreach ($contacts as $key => $contact) {
            $form_data['contacts'][$key] = ['role' => $available_roles[random_int(1, 2)]];
        }


        $response = $this->post(route('jiris.store'), $form_data);
        $response->assertStatus(302);

        expect(Jiri::all()->count())->toBe(1)
            ->and(Project::all()->count())->toBe(3)
            ->and(Contact::all()->count())->toBe(4)
            ->and(Attendance::all()->count())->toBe(4)
            ->and(Homework::all()->count())->toBe(3)
            ->and(Implementation::all()->count())->toBe(12);
    }
);
