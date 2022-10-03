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
    }//What if we have thousands of products?

    public function show(Product $product): Response
    {
        return Inertia::render('Products/Show', compact('product'));
    }//excellent

    public function create(): Response
    {
        $categories = Category::all();
        return Inertia::render('Products/Create', compact('categories'));
    }//excellent

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required', // what if user sends text instead of integer
            'description' => 'required',
            'image' => 'required', // what if user sends pdf or any other mime?
        ]);
        $length = count($validated['image']); // hmm, if image can be countable than its probably images.
        $allImages = ''; 
        for($i = 0; $i < $length; $i++) {
            $newImageName = time() . '-' . $request->name . '-' . $i . '.' . $request->image[$i]->extension();// nice
            $request->image[$i]->move(public_path('images'), $newImageName); //nice
            $allImages = $allImages . $newImageName . ', '; //nice
        }

        $category = Category::query()->find($request['category_id']); //we never validate category_id. How we are sure its not nullable?
        $category->products()->create([ //possible null pointer exception
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $allImages,
        ]); //nice
        return Redirect::route('products.index');

    }

    public function edit(Product $product): Response
    {
        $categories = Category::all();
        return Inertia::render('Products/Edit', compact('product', 'categories'));
    }//excellent

    public function update(Product $product, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required', //what if users sends non integer
            'description' => 'required',
            //updating images?
        ]);

        $product->fill($validated);
        $product->save();
        return Redirect::route('products.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete(); //what about images? do we delete them from storage
        return Redirect::route('products.index');
    }
}
