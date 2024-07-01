<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'name',
        'company',
        'phone',
        'email',
        'created_at',
        'updated_at',
    ];

}