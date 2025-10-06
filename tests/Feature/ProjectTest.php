<?php

use App\Models\Project;

it(
    'create a Project and redirect to the project index',
    function () {
        // Arrange
        $project = [
            'name' => 'Client',
        ];

        // Act
        $response = $this->post('/projects', $project);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('projects');
        \Pest\Laravel\assertDatabaseHas('projects', ['name' => 'Client']);
    }
);

it(
    'display a complete list of projects on the project index page',
    function () {
        // Arrange
        $projects = Project::factory(4)->create();

        // Act
        $response = $this->get('/projects');

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('projects.index');
        $response->assertSee('Liste des projets');

        foreach ($projects as $project) {
            $response->assertSee($project['name']);
        }
    });

it(
    'verify if the link in project is the same of the project dashboard',
    function () {
        // Arrange
        $project = Project::factory()->create();

        // Act
        $response = $this->get('/projects/'.$project->id);

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('projects.show');
        $response->assertSee('Récapitulatif des projects : '.$project->name);

    });

it(
    'check the validation',
    function () {

        $project = [
            'name' => '',
        ];

        $response = $this->post('/projects', $project);

        $response->assertInvalid('name');
    });
