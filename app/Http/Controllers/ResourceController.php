<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResourceRequest;
use App\Http\Resources\ResourceResource;
use App\Models\User;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resources.
     */
    public function getAllResources()
    {
        //
        $response = [];
        return response()->success(ResourceResource::collection($response));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeResource(StoreResourceRequest $request)
    {
        //
    }

}
