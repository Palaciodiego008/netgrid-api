<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use HasFactory, Notifiable;

        /**
        * The attributes that are mass assignable.
        *
        * @var array<int, string>
        */

        protected $fillable = [
            'title',
            'description',
            'start_date',
            'end_date',
            'task_id'
        ];
}
