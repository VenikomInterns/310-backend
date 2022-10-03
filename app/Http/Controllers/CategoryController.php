<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{

    public function index(): Response
    {
        $categories = Category::all();
        return Inertia::render('Categories/Index', compact('categories'));
    }//excellent

    public function show(Category $category): Response
    {
        return Inertia::render('Categories/Show', compact('category'));
    }//excellent

    public function create(): Response
    {
        return Inertia::render('Categories/Create');
    }//excellent

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        Category::query()->create($validated);

        return Redirect::route('categories.index');
    }//excellent

    public function edit(Category $category): Response
    {
        return Inertia::render('Categories/Edit', compact('category'));
    }//excellent

    public function update(Category $category, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $category->fill($validated);
        $category->save();
        return Redirect::route('categories.index');
    }//excellent

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete(); //what if this category has products?
        return Redirect::route('categories.index');
    }

}
