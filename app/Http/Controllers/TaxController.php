<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Tax;


class TaxController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function create()
  {
      $taxes = Tax::paginate(10);
      return view('tax.create',compact('taxes'));
  }
  public function store(Request $request)
  {
      $this->validate($request, [
          'tax_name' => 'required|max:50',
          'tax_rate' => 'required|numeric',
          'sgst_name' => 'required|max:50',
          'sgst_rate' => 'required|numeric',
          'cgst_name' => 'required|max:50',
          'cgst_rate' => 'required|numeric',
          'igst_name' => 'required|max:50',
          'igst_rate' => 'required|numeric',

      ]);

      $tax = Tax::create([
          'tax_name' => $request['tax_name'],
          'tax_rate' => $request['tax_rate'],
          'sgst_name' => $request['sgst_name'],
          'sgst_rate' => $request['sgst_rate'],
          'cgst_name' => $request['cgst_name'],
          'cgst_rate' => $request['cgst_rate'],
          'igst_name' => $request['igst_name'],
          'igst_rate' => $request['igst_rate'],
          'created_by' => Auth::User()->username,
      ]);

      return redirect('/tax/create/')->with('success-message', 'Tax '.$tax->tax_name.' is successfully Created...!');
  }
  public function edit(Tax $tax)
      {
        $taxes = Tax::paginate(10);
          return view('tax.edit',compact('taxes','tax'));
      }

  public function update(Request $request, Tax  $tax)
  {
        $this->validate($request, [
          'tax_name' => 'required|max:50',
          'tax_rate' => 'required|numeric',
          'sgst_name' => 'required|max:50',
          'sgst_rate' => 'required|numeric',
          'cgst_name' => 'required|max:50',
          'cgst_rate' => 'required|numeric',
          'igst_name' => 'required|max:50',
          'igst_rate' => 'required|numeric',
        ]);

        Tax::where('tax_id',$tax->tax_id)->update([
          'tax_name' => $request['tax_name'],
          'tax_rate' => $request['tax_rate'],
          'sgst_name' => $request['sgst_name'],
          'sgst_rate' => $request['sgst_rate'],
          'cgst_name' => $request['cgst_name'],
          'cgst_rate' => $request['cgst_rate'],
          'igst_name' => $request['igst_name'],
          'igst_rate' => $request['igst_rate'],
          'updated_by' => Auth::User()->username,

          ]);

      return redirect('/tax/create/')->with('success-message', 'Tax '.$tax->tax_name.' is successfully Updated...!');
   }
   public function delete(Request $request)
   {
       Tax::where('tax_id',$request->tax_id)->delete();
   }

   public function search(Request $request)
{
   $this->validate($request, [
       'search' => 'required'
   ]);

   $taxes = Tax::
       where('tax_name', 'like', "%$request->search%")
       ->orWhere('tax_rate', 'like', "%$request->search%")
       ->orWhere('sgst_name', 'like', "%$request->search%")
       ->orWhere('sgst_rate', 'like', "%$request->search%")
       ->orWhere('cgst_name', 'like', "%$request->search%")
       ->orWhere('cgst_rate', 'like', "%$request->search%")
       ->orWhere('igst_name', 'like', "%$request->search%")
       ->orWhere('igst_rate', 'like', "%$request->search%")
       ->paginate(10)
       ->appends(['search' => $request->search]);
   return view('tax.create',compact('taxes'));
}

}
