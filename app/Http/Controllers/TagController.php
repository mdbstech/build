<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Tag;


class TagController extends Controller
{
    public function __construct()
  {
      $this->middleware('auth');
  }
  public function create()
  {
      $tags = Tag::paginate(10);
      return view('tag.create',compact('tags'));
  }
  public function store(Request $request)
  {
      $this->validate($request, [
          'tag_name' => 'required|max:50',
          'tag_color' => 'required|max:50',
          
      ]);

      $tag = Tag::create([
          'tag_name' => $request['tag_name'],
          'tag_color' => $request['tag_color'],
          'created_by' => Auth::User()->username,
      ]);

      return redirect('/tag/create/')->with('success-message', 'Tag '.$tag->tag_name.' is successfully Created...!');
  }
  public function edit(Tag $tag)
      {
        $tags = Tag::paginate(10);
          return view('tag.edit',compact('tags','tag'));
      }

  public function update(Request $request, Tag  $tag)
  {
        $this->validate($request, [
        	'tag_name' => 'required|max:50',
         	'tag_color' => 'required|max:50',
         
        ]);

        Tag::where('tag_id',$tag->tag_id)->update([
          'tag_name' => $request['tag_name'],
          'tag_color' => $request['tag_color'],
          'updated_by' => Auth::User()->username,

          ]);

      return redirect('/tag/create/')->with('success-message', 'Tag '.$tag->tag_name.' is successfully Updated...!');
   }
   public function delete(Request $request)
   {
       Tag::where('tag_id',$request->tag_id)->delete();
   }
   public function search(Request $request)
   {

      $this->validate($request, [
          'search' => 'required'
     ]);

      $tags = Tag::
         where('tag_name', 'like', "%$request->search%")
          ->orWhere('tag_color', 'like', "%$request->search%")
       	  ->paginate(10)
          ->appends(['search' => $request->search]);
      return view('tag.create',compact('tags'));
    }

}
