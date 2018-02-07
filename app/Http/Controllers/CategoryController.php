<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Category;

class CategoryController extends Controller
{
   public function __construct()
  {
      $this->middleware('auth');
  }
   public function create()
  {
      $categories = Category::paginate(10);
      return view('category.create',compact('categories'));
  }
  public function store(Request $request)
  {
      $this->validate($request, [
          'category_name' => 'required|max:50',
          'color' => 'required|max:50',
          'description' => ' ',
          
      ]);

      $category = Category::create([
          'category_name' => $request['category_name'],
          'color' => $request['color'],
          'description' => $request['description'],
          'created_by' => Auth::User()->username,
      ]);

      return redirect('/category/create/')->with('success-message', 'Category '.$category->category_name.' is successfully Created...!');
  }
   public function edit(Category $category)
      {
        $categories = Category::paginate(10);
          return view('category.edit',compact('categories','category'));
      }
      public function update(Request $request, Category  $category)
  {
        $this->validate($request, [
        	'category_name' => 'required|max:50',
          	'color' => 'required|max:50',
          	'description' => ' ',
         
        ]);

        Category::where('category_id',$category->category_id)->update([
          'category_name' => $request['category_name'],
          'color' => $request['color'],
          'description' => $request['description'],
          'updated_by' => Auth::User()->username,

          ]);

      return redirect('/category/create/')->with('success-message', 'Category '.$category->category_name.' is successfully Updated...!');
   }
   public function delete(Request $request)
   {
       Category::where('category_id',$request->category_id)->delete();
   }
   public function search(Request $request)
   {

      $this->validate($request, [
          'search' => 'required'
     ]);

      $categories = Category::
         where('category_name', 'like', "%$request->search%")
          ->orWhere('color', 'like', "%$request->search%")
          ->orWhere('description', 'like', "%$request->search%")
       	  ->paginate(10)
          ->appends(['search' => $request->search]);
      return view('category.create',compact('categories'));
    }
}
