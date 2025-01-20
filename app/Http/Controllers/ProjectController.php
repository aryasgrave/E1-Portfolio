<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        $search = $request->get('search', '');
        $tagId = $request->get('tag', '');

        $projects = Project::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($tagId, function ($query, $tagId) {
                $query->whereHas('tags', function ($query) use ($tagId) {
                    $query->where('tags.id', $tagId);
                });
            })
            ->with('tags')
            ->get();

        $tags = Tag::all();

        return view('welcome', compact('users', 'projects', 'tags'));
    }

    public function dashboard()
    {
        $projects = Project::all();
        $tags = Tag::all();
        return view('dashboard', compact('projects'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('projects.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required|image',
            'link' => 'required|url',
            'tags' => 'array|nullable',
            'tags.*' => 'exists:tags,id',
        ]);

        $photoPath = $request->file('photo')->storeAs(
            'images/projects',
            time() . '.' . $request->file('photo')->getClientOriginalExtension(),
            'public'
        );

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'photo' => $photoPath,
        ]);

        if ($request->tags) {
            $project->tags()->sync($request->tags);
        }

        return redirect()->route('dashboard')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $tags = Tag::all();
        return view('projects.edit', compact('project', 'tags'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image',
            'link' => 'required|url',
            'tags' => 'array|nullable',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('photo')) {
            if ($project->photo && file_exists(public_path($project->photo))) {
                unlink(public_path($project->photo));
            }

            $photoPath = $request->file('photo')->storeAs(
                'images/projects',
                time() . '.' . $request->file('photo')->getClientOriginalExtension(),
                'public'
            );

            $project->photo = $photoPath;
        }

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
        ]);

        $project->tags()->sync($request->tags ?? []);

        return redirect()->route('dashboard')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->photo && file_exists(public_path($project->photo))) {
            unlink(public_path($project->photo));
        }

        $project->delete();

        return redirect()->route('dashboard')->with('success', 'Project deleted successfully.');
    }
}
