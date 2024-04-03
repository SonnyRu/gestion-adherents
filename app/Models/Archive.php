<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = ['id', 'name', 'first_name', 'email', 'phone_number', 'role'];

    protected $table = 'archives';
    use HasFactory;
}
