<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public $timestamps=false;
protected  $table = 'logs';
protected $fillable = [
   'id',
    'URI',
    'METHOD',
    'REQUEST_BODY',
    'RESPONSE'

];

}
