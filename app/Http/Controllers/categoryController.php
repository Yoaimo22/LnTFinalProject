<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function createCategory(){
        return view('createCategory',[
            'title' => 'Add New Category'
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect('/dashboard');
    }

    public function index(){
        return view('CategoriesIndex',[
            'title' => 'Categories',
            'categories' => Category::all()
        ]);
    }
}
