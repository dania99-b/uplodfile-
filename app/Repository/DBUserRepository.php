<?php
namespace App\Repository;
use App\Models\User;
use App\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Http;

class DBUserRepository implements UserRepositoryInterface {
 private $url="http://127.0.0.1:8000/";

    public function all()
    {
        $response =Http::get($this->url,"alluser");
        $users=$response->body(get()->first()->id);
        $users=json_decode($users);
        return $users;
    }

    public function create($attribute)
    {
       return User::create($attribute);
    }

    public function condition($attribute, $attribute2)
    {
       return User::where($attribute,$attribute2);
    }
}
