<?php

namespace App\Models;

use App\Models\Task as ModelsTask;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path(){

        return "/projects/{$this->id}";
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tasks(){
        return $this->hasMany(ModelsTask::class);
    }

    public function addTask($body){
        return $this->tasks()->create(compact('body'));
    }
}
