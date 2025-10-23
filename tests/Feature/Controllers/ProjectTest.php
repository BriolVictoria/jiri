<?php

use App\Models\Project;
use App\Models\User;

it(
    'it verifies if you can visit the projects.edit route',
    function () {
        $user = User::factory()->create();
        \Pest\Laravel\actingAs($user);

        $project = \App\Models\Project::factory()->for($user)->create();

        $response = $this->get(route('projects.edit', $project->id));

        $response->assertStatus(200);
        $response->assertViewIs('projects.edit');
        $response->assertSee('Modifiez le projet');
    }
);

it(
    'verifies if a project is correctly modified in the database',
    function () {
        $user = User::factory()->create();

        \Pest\Laravel\actingAs($user);

        $project = Project::factory()->for($user)->create();

        $modify_data = [
            'name' => 'Design Web',
        ];

        $response = $this->patch(route('projects.update', $project->id), $modify_data);

        $response->assertStatus(302);
        $response->assertRedirect(route('projects.show', $project->id));

        \Pest\Laravel\assertDatabaseMissing('projects', [
            'name' => $project->name,
        ]);

        \Pest\Laravel\assertDatabaseHas('projects', [
            'name' => $modify_data['name'],
        ]);

    }
);
