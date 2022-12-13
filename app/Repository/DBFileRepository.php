<?php


namespace App\Repository;


use App\Models\File;
use App\RepositoryInterface\FileRepositoryInterface;

class DBFileRepository implements FileRepositoryInterface
{
    private $url="http://127.0.0.1:8000/";

    public function all()
    {
       return File::all();
    }

    public function create($attribute)
    {
        return File::create($attribute);
    }

    public function findbyID($attribute)
    {
       return File::find($attribute);
    }

    public function exactsave()
    {
     return File::save();
    }
    public function condition($attribute, $attribute2)
    {
       return File::where($attribute,$attribute2);
    }
}
