<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductApiController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $compare = $request['category_id'];
        if($compare===null) {
            $filtered = Product::query()->paginate(10);
        }
        else {
            $filtered = Product::all()->filter(function ($item) use ($compare) {
                return $item->category_id == $compare;
            });
        }

        return JsonResource::collection($filtered);

    }

    public function show(Product $product): JsonResource
    {
        return JsonResource::make($product);
    }
}
