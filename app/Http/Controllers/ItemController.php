<?php

namespace App\Http\Controllers;

use App\Http\Services\ItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(public ItemService $itemService)
    {
    }

    public function apply(Request $request): JsonResponse
    {
        return new JsonResponse($this->itemService->apply($request->all()));
    }
}
