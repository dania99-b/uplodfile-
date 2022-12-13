<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = [
        'id',
        'name',
        'path',
        'status',
        'user_id'
    ];
    public function checklists(){
        return $this->belongsTo(User::class);
    }


    public function file_group(){
        return $this->belongsToMany(Group::class, 'file_group')->withPivot( 'group_id','file_id');
    }

    public function report()
    {
        return $this->hasOne('app/Models/Report.php');
    }

}
