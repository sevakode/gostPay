<?php

namespace App\Http\Controllers;

use App\Models\Bank\Project;
use App\Notifications\DataNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification as Notify;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function list()
    {
        $page_title = 'Проекты';
        $page_description = $page_title;

        return view('pages.manager.projects.list', compact('page_title', 'page_description'));
    }

    public function create()
    {
        $page_title = 'Создать проект';
        $page_description = $page_title;

        return view('pages.manager.projects.create',
            compact('page_title', 'page_description'));
    }

    public function creating(Request $request)
    {
        $isSlugExists = Project::where('slug', $request->slug)->exists();

        if($isSlugExists) {
            DataNotification::sendErrors(
                ['Такой проект уже существует!', 'Пожалуйста, Измените slug проекта'],
                $request->user()
            );

            return Redirect::back()->withInput();
        }

        $project = Project::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'company_id' => $request->user()->company_id
        ]);

        Notify::send($request->user(), DataNotification::success());

        return redirect(route('projects'));
    }

    public function update($slug)
    {
        $page_title = 'Создать проект';
        $page_description = $page_title;

        $project = \request()->user()->company->projects()->whereSlug($slug)->first();

        return view('pages.manager.projects.update', compact('page_title', 'page_description', 'project'));
    }

    public function updating(Request $request, $slug)
    {
        $project = \request()->user()->company->projects()->whereSlug($slug)->first();
        $project->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'company_id' => $request->user()->company_id
        ]);

        Notify::send($request->user(), DataNotification::success());

        return redirect(route('projects'));
    }

    public function show($slug)
    {
        $project = \request()->user()->company->projects()->whereSlug($slug)->first();

        $page_title = 'Проект ' . $project->name;
        $page_description = $page_title;

        return view('pages.manager.projects.show', compact('page_title', 'page_description', 'project'));
    }
}
