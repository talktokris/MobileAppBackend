<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member_tranings_data extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'name',
        'org',
        'country',
        'startDate',
        'endDate',
        'status'
    ];


}