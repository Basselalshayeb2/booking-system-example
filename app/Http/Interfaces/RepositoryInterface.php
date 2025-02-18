<?php

namespace App\Http\Interfaces;

interface RepositoryInterface
{
    public function all();
    public function save($data);
}
