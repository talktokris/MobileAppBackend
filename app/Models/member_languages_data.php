<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_languages_data extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'language_name',
        'language_level',
        'status'
    ];

    public function getMemberInfo(){

        return $this->belongsTo(Member::class, 'id', 'user_id');

    }
}
