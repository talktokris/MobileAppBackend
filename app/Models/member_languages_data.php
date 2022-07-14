<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member_languages_data extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'language_name',
        'language_level',
        'status'
    ];
}