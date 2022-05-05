<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMsg extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'message'
    ];
}
