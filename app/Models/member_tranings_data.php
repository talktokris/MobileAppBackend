<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_tranings_data extends Model
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


    public function getMemberInfo(){

        return $this->belongsTo(Member::class, 'id', 'member_id');

    }
}