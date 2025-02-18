<?php

namespace App\Http\Interfaces;

interface ResourceRepositoryInterface extends RepositoryInterface
{
    public function findById($id);
}
