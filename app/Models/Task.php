<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_no',
        'title',
        'description',
        'lead_id',
        'budget',
        'progress',
        'start_time',
        'end_time',
        'assign_from',
    ];

    public function lead()
    {
        return $this->belongsTo('App\Models\Lead');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
