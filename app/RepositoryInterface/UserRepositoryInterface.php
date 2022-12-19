<?php
namespace app\RepositoryInterface;
interface UserRepositoryInterface {
    public function all();
    public function register($attribute);
    public function condition($attribute,$attribute2);
    public function login($attribute);
}
