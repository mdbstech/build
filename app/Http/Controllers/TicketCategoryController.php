<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\TicketCategory;



class TicketCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $id = TicketCategory::max('category_id');
        $ticket_category_code = $id + 1;
        $length = strlen($ticket_category_code);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++)
        {
            $ticket_category_code = '0'.$ticket_category_code;
        }
        $ticket_categories = TicketCategory::paginate(10);
        return view('ticket_category.create',compact('ticket_categories','ticket_category_code'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'ticket_category_code' => 'required|max:20',
            'category_name' => 'required|max:50',
            'color' => 'required|max:50',
            'description' => 'max:2550',

        ]);

        $ticket_category = TicketCategory::create([
            'ticket_category_code' => $request['ticket_category_code'],
            'category_name' => $request['category_name'],
            'color' => $request['color'],
            'description' => $request['description'],
            'created_by' => Auth::User()->username,
        ]);

        return redirect('/ticket_category/create/')->with('success-message', 'TicketCategory '.$ticket_category->category_no.' is successfully Created...!');
    }
    public function edit(TicketCategory $ticket_category)
    {
        $ticket_categories = TicketCategory::paginate(10);
        return view('ticket_category.edit',compact('ticket_categories','ticket_category'));
    }
    public function update(Request $request, TicketCategory  $ticket_category)
    {
        $this->validate($request, [
            'ticket_category_code' => 'required|max:20',
            'color' => 'required|max:50',
            'category_name' => 'required|max:50',
            'description' => 'max:2550',
        ]);

        TicketCategory::where('category_id',$ticket_category->category_id)->update([
            'ticket_category_code' => $request['ticket_category_code'],
            'category_name' => $request['category_name'],
            'color' => $request['color'],
            'description' => $request['description'],
            'updated_by' => Auth::User()->username,

        ]);

        return redirect('/ticket_category/create/')->with('success-message', 'TicketCategory '.$ticket_category->category_no.' is successfully Updated...!');
    }
    public function delete(Request $request)
    {
        TicketCategory::where('category_id',$request->category_id)->delete();
    }
    public function search(Request $request)
    {

        $this->validate($request, [
            'search' => 'required'
        ]);
        $id = TicketCategory::max('category_id');
        $ticket_category_code = $id + 1;
        $length = strlen($ticket_category_code);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++)
        {
            $ticket_category_code = '0'.$ticket_category_code;
        }
        $ticket_categories = TicketCategory::
            where('category_name', 'like', "%$request->search%")
            ->orWhere('ticket_category_code', 'like', "%$request->search%")
            ->orWhere('description', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('ticket_category.create',compact('ticket_categories','ticket_category_code'));
    } 
}
