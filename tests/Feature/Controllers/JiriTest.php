<?php

use App\Enums\ContactRoles;
use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Homework;
use App\Models\Implementation;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\post;

it(
    'create successfully a jiri from the data provided by the request',
    function () {
        // Arrange
        $user = User::factory()->create();
        actingAs($user);

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
        //Arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()
            ->withoutName()
            ->raw();

        //Act
        $response = post(route('jiris.store'), $jiri);
        //expect($response)->toThrow(\Illuminate\Database\QueryException::class);

        //Assert
        $response->assertInvalid('name');
        \Pest\Laravel\assertDatabaseEmpty('jiris');

    }
);

it(
    'fails to create a new jiri in database when the date is missing in the request',
    function () {
        //Arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()
            ->withoutDate()
            ->raw();

        //Act
        $response = post(route('jiris.store'), $jiri);
        //expect($response)->toThrow(\Illuminate\Database\QueryException::class);

        //Assert
        $response->assertInvalid('date');
        \Pest\Laravel\assertDatabaseEmpty('jiris');

    }
);

it(
    'fails to create a new jiri in database when the date has the wrong format in the request',
    function () {
        //Arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()
            ->withInvalidDate()
            ->raw();

        //Act
        $response = post(route('jiris.store'), $jiri);
        //expect($response)->toThrow(\Illuminate\Database\QueryException::class);

        //Assert
        $response->assertInvalid('date');
        \Pest\Laravel\assertDatabaseEmpty('jiris');

    }
);

it(
    'display a complete list of jiris on the jiri index page',
    function () {
        // Arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiris = Jiri::factory(4)->for($user)->create();

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
        $response = $this->get(route('jiris.show', ['jiri' => $jiri->id]));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('jiris.show');
        $response->assertSee('Récapitulatif du jiri');
    }
);

it(
    'verifies if jiri data is correctly inserted in the DB when you create a Jiri with projects',
    function () {
        //Arrange
        $user = User::factory()->create();
        actingAs($user);

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

        //Act
        $response = $this->post(route('jiris.store'), $form_data);

        //Assert
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
        //Arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()->raw();

        $contacts = Contact::factory()
            ->count(4)
            ->for($user)
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

        //Act
        $response = $this->post(route('jiris.store'), $form_data);

        //Assert
        $response->assertStatus(302);
        expect(Jiri::all()->count())->toBe(1)
            ->and(Contact::all()->count())->toBe(4)
            ->and(Attendance::all()->count())->toBe(4);
    }
);

it(
    'verifies if jiri data is correctly inserted in the DB when you create a Jiri with contacts and projects',
    function () {
        //Arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()->raw();

        $contacts = Contact::factory()
            ->count(4)
            ->for($user)
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

        //Act
        $response = $this->post(route('jiris.store'), $form_data);

        //Assert
        $response->assertStatus(302);

        expect(Jiri::all()->count())->toBe(1)
            ->and(Project::all()->count())->toBe(3)
            ->and(Contact::all()->count())->toBe(4)
            ->and(Attendance::all()->count())->toBe(4)
            ->and(Homework::all()->count())->toBe(3)
            ->and(Implementation::all()->count())->toBe(12);
    }
);

it('verifies if jiri data is correctly modified in the database when you edit the information about a jiri',
    function () {
        $user = User::factory()->create();
        actingAs($user);
        Event::fake('eloquent.created: App\Models\Jiri');

        // Créer en DB
        $available_roles = [
            1 => ContactRoles::Evaluated->value,
            2 => ContactRoles::Evaluated->value,
        ];

        $jiri = Jiri::factory()
            ->for($user)
            ->create();

        $contacts = Contact::factory()
            ->count(3)
            ->for($user)
            ->create()
            ->pluck('id', 'id')
            ->toArray();

        $projects = Project::factory()
            ->count(3)
            ->for($user)
            ->create()
            ->pluck('id', 'id')
            ->toArray();

        $jiri->contacts()->attach($contacts, ['role' => $available_roles[rand(1, 2)]]);
        $jiri->projects()->attach($projects);

        // Créer un array requête de base
        $data_in_database = array_merge($jiri->toArray(), [
            'projects' => $projects,
            'contacts' => $contacts,
        ]);

        foreach ($contacts as $key => $contact) {
            $data_in_database['contacts'][$key] = array('role' => $available_roles[rand(1, 2)]);
        }

        // Créer un array requête modifié
        $data_in_request = $data_in_database;

        $data_in_request['name'] = 'Ambre briol';
        $data_in_request['description'] = 'Salut la description';

        $new_project = Project::factory()->for($user)->create();
        $data_in_request['projects'][$new_project->id] = $new_project->id;
        unset($data_in_request['projects'][1]);

        $new_contact = Contact::factory()->for($user)->create();
        $data_in_request['contacts'][$new_contact->id]['role'] = ContactRoles::Evaluated->value;
        $data_in_request['contacts'][1]['role'] = ContactRoles::Evaluators->value;
        $data_in_request['contacts'][2]['role'] = ContactRoles::Evaluated->value;
        unset($data_in_request['contacts'][3]);

        $response = $this->patch(route('jiris.update', $jiri['id']), $data_in_request);


        assertDatabaseHas('jiris',
            [
                'name' => $data_in_request['name'],
                'description' => $data_in_request['description'],
            ]);

        assertDatabaseMissing('jiris',
            [
                'name' => $data_in_database['name'],
                'description' => $data_in_database['description'],
            ]);

        assertDatabaseMissing('homeworks',
            [
                'jiri_id' => 1,
                'project_id' => 1
            ]);

        assertDatabaseHas('homeworks',
            [
                'jiri_id' => 1,
                'project_id' => 2
            ]);

        assertDatabaseHas('attendances',
            [
                'contact_id' => 1,
                'jiri_id' => 1,
                'role' => ContactRoles::Evaluators->value,
            ]);

        assertDatabaseMissing('attendances',
            [
                'contact_id' => 3,
                'jiri_id' => 1,
                'role' => ContactRoles::Evaluators->value,
            ]);
    }
);
