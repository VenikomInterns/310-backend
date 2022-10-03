<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::all();
        $categories = Category::all();
        return Inertia::render('Products/Index', compact('products', 'categories'));
    }

    public function show(Product $product): Response
    {
        return Inertia::render('Products/Show', compact('product'));
    }

    public function create(): Response
    {
        $categories = Category::all();
        return Inertia::render('Products/Create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);
        $length = count($validated['image']);
        $allImages = '';
        for($i = 0; $i < $length; $i++) {
            $newImageName = time() . '-' . $request->name . '-' . $i . '.' . $request->image[$i]->extension();
            $request->image[$i]->move(public_path('images'), $newImageName);
            $allImages = $allImages . $newImageName . ', ';
        }

        $category = Category::query()->find($request['category_id']);
        $category->products()->create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $allImages,
        ]);
        return Redirect::route('products.index');

    }

    public function edit(Product $product): Response
    {
        $categories = Category::all();
        return Inertia::render('Products/Edit', compact('product', 'categories'));
    }

    public function update(Product $product, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $product->fill($validated);
        $product->save();
        return Redirect::route('products.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return Redirect::route('products.index');
    }
}
