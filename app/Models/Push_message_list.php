<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Push_message_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_id',
        'title',
        'message',
        'send_status',
        'read_status',
        'status',

    ];

    public function geMessageIdInfo(){

        return $this->belongsTo(User::class, 'id', 'user_id');

    }
}
