<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ResourceRepositoryInterface;
use App\Models\Resource;

class ResourceRepository implements ResourceRepositoryInterface
{
    public function all()
    {
        return Resource::all();
    }

    public function save($data)
    {
        return Resource::create($data);
    }
}
