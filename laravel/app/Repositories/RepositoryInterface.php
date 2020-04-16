<?php 
namespace App\Repositories;
// use App\User;

interface RepositoryInterface
{
    public function paginate($quantity);
    public function persist($data);
}