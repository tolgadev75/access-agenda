<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'date',
        'start_time',
        'end_time',
        'sport_type',
        'is_accessible_mobility',
        'is_accessible_vision',
        'is_accessible_hearing',
        'is_accessible_cognitive',
        'accessibility_details',
        'contact_email',
        'contact_phone',
        'organizer',
        'max_participants',
    ];

    protected $casts = [
        'date' => 'date',
        'is_accessible_mobility' => 'boolean',
        'is_accessible_vision' => 'boolean',
        'is_accessible_hearing' => 'boolean',
        'is_accessible_cognitive' => 'boolean',
    ];
}
