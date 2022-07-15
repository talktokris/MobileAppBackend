<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience_level_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status'
    ];
}