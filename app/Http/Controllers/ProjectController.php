<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required',
        ]);

        Project::create(request()->all());

        return redirect(route('projects.index'));
    }

    public function update(Project $project)
    {
        $validatedData = request()->validate([
            'name' => 'required',
        ]);

        $project->upsert(
            [
                [
                    'id'=> $project->id,
                    'user_id' => auth()->user()->id,
                    'name' => $validatedData['name'],
                ],
            ],
            'id',
            ['name'],
        );

        return redirect(route('projects.show', $project->id));
    }

    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }
}
