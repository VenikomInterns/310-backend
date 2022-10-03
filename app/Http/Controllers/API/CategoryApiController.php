<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::query()->paginate(10);
        return JsonResource::collection($categories);
    }

    public function show(Category $category): JsonResource
    {
        return JsonResource::make($category);
    }
}
