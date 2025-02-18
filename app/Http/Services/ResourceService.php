<?php

namespace App\Http\Services;

use App\Http\Interfaces\ResourceRepositoryInterface;
use App\Models\Resource;

class ResourceService
{
    public function __construct(protected ResourceRepositoryInterface $resourceRepository)
    {
    }

    public function getAllResources(): mixed
    {
        return $this->resourceRepository->all();
    }

    public function storeResource(mixed $data): mixed
    {
        return $this->resourceRepository->save($data);
    }
}
