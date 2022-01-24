<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    //laravel will not try to update the fields 'created_at' and 'updated_at'
    public $timestamps = false;

    protected $table='Messages';
    protected $primaryKey='id';
    public $incrementing = true;

}
