<?php


namespace App\RepositoryInterface;


interface GroupRepositoryInterface
{
    public function all();
    public function addgroup($attribute);
    public function findbyID($attribute);
    public function exactsave();
    public function condition($attribute,$attribute2);
    public function add_fileto_group($attribute);
    public function delete_filefrom_group($attribute);
    public function add_user_togroup($attribute);
    public function delete_userfrom_group($attribute);
    public function delete_group_($attribute);
    public function show_user_group();
    public function show_file_group($attribute);
    public function show_all_group();


}
