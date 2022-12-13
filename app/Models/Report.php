<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = [
        'id',
        'file_id',
        'operation_name',
        'operation_date',
        'username'
    ];
    public function file()
    {
        return $this->belongsTo('App\Models\File');
    }

}
