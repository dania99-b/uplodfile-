<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = [
        'id',
        'name',
        'user_id'
    ];
    public function checklists(){
        return $this->belongsTo(User::class);
    }


    public function file_group(){
        return $this->belongsToMany(File::class, 'file_group')->withPivot( 'group_id','file_id');
    }
    public function user_group(){
        return $this->belongsToMany(User::class, 'user_group')->withPivot( 'group_id','user_id');
    }
}
