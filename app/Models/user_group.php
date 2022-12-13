<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_group extends Model
{
    use HasFactory;
    protected $table = "user_group";
    public $timestamps=false;
    protected $fillable = [
        'user_id',
        'group_id',
    ];

    public function file_group(){
        return $this->hasMany(File_group::class);
    }
}
