<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'email',
        'password',
        'sex',
        'dob',
        'height',
        'weight',
        'nationality',
        'emailStatus',
        'mobileNo',
        'mobileStatus',
        'counryliveIn',
        'profileType',
        'profileTitle',
        'image',
        'status'
    ];



}
