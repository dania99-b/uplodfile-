<?php


namespace App\RepositoryInterface;


interface FileRepositoryInterface
{
    public function all();
    public function create($attribute);
public function findbyID($attribute);
public function exactsave();
public function condition($attribute,$attribute2);

}
