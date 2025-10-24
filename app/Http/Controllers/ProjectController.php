<?php

namespace App\Http\Controllers;

use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Str;

class ProjectController extends Controller
{
    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required',
        ]);

        $user = Auth::user();

        $project = $user->projects()->create($validatedData);

        return redirect(route('projects.show', compact('project')));

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
        $projects = request()->user()->projects()->orderBy('name')->paginate(6);


        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $jiris = Jiri::all();
        return view('projects.show', compact('project', 'jiris'));
    }

    public function edit(Project $project)
    {
        $jiris = Jiri::all();
        return view('projects.edit', compact('project', 'jiris'));
    }

    public function create()
    {
        $jiris = Jiri::all();
        return view('projects.create', compact('jiris'));
    }
}
