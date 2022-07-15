<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'capital',
        'codeCurrency',
        'codeFips',
        'codeIso2Country',
        'codeIso3Country',
        'continent',
        'nameCurrency',
        'numericIso',
        'phonePrefix',
        'status'
    ];
}