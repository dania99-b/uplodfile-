<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_group extends Model
{
    use HasFactory;
    protected $table = "file_group";
    public $timestamps=false;
    protected $fillable = [
        'group_id',
        'file_id',
        'user_group_id'
    ];
    public function file_group(){
        return $this->belongsTo(User_group::class);
    }

}
