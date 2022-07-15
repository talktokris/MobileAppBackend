<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_skill_data extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'skillName',
        'skill_level',
        'status'
    ];

    public function getMemberInfo(){

        return $this->belongsTo(Member::class, 'id', 'member_id');

    }
}