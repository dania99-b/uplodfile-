<?php


namespace App\Repository;


use App\Models\Group;
use App\RepositoryInterface\GroupRepositoryInterface;

class DBGroupRepository implements GroupRepositoryInterface
{
    private $url="http://127.0.0.1:8000/";

    public function all()
    {
        return Group::all();
    }

    public function create($attribute)
    {
        return Group::create($attribute);
    }

    public function findbyID($attribute)
    {
        return Group::find($attribute);
    }

    public function exactsave()
    {
        return Group::save();
    }
    public function condition($attribute, $attribute2)
    {
        return Group::where($attribute,$attribute2);
    }
}
