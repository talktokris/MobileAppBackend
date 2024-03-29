<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_experiences_data extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post',
        'company',
        'country',
        'startDate',
        'endDate',
        'status'
    ];

    public function getMemberInfo(){

        return $this->belongsTo(User::class, 'id', 'user_id');

    }
}