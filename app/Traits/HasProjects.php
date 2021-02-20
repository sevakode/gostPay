<?php namespace App\Traits;

use App\Models\Bank\Project;

Trait HasProjects
{
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getProjectsAttribute()
    {
        return $this->projects()->get();
    }
}
