<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_educations_data extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'level',
        'school',
        'country',
        'subject',
        'startDate',
        'endDate',
        'status'
    ];

    public function getMemberInfo(){

        return $this->belongsTo(User::class, 'id', 'user_id');

    }
}