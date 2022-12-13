<?php
namespace app\RepositoryInterface;
interface UserRepositoryInterface {
    public function all();
    public function create($attribute);
    public function condition($attribute,$attribute2);
}
