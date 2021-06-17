<?php

use App\Http\Controllers\ProjectController;
use App\Interfaces\OptionsPermissions;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'list'])->name('projects')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_ALL_PROJECTS_COMPANY['slug']);

Route::get('create', [ProjectController::class, 'create'])
    ->name('projects.create')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_CREATE_PROJECTS_COMPANY['slug']);
Route::post('creating', [ProjectController::class, 'creating'])
    ->name('projects.creating')
    ->middleware('auth.demo')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_CREATE_PROJECTS_COMPANY['slug']);

Route::get('{slug}/edit', [ProjectController::class, 'update'])
    ->name('projects.edit')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_UPDATE_PROJECTS_COMPANY['slug']);
Route::post('{slug}/updating', [ProjectController::class, 'updating'])
    ->name('projects.updating')
    ->middleware('auth.demo')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_UPDATE_PROJECTS_COMPANY['slug']);

Route::get('{slug}/show', [ProjectController::class, 'show'])
    ->name('projects.show')
    ->middleware('auth.permission:'.OptionsPermissions::ACCESS_TO_SHOW_PROJECTS_COMPANY['slug']);
