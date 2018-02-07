<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\PaymentTerm;

class PaymentTermController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function create()
  {
      $payment_terms = PaymentTerm::paginate(10);
      return view('payment_term.create',compact('payment_terms'));
  }
  public function store(Request $request)
  {
      $this->validate($request, [
          'payment_term' => 'required|max:50',
          'no_of_days' => 'required|numeric',

      ]);

      $payment_terms = PaymentTerm::create([
          'payment_term' => $request['payment_term'],
          'no_of_days' => $request['no_of_days'],
          'created_by' => Auth::User()->username,
      ]);

      return redirect('/payment_term/create/')->with('success-message', 'Payment Term '.$payment_terms->payment_term.' is successfully Created...!');
  }
  public function edit(PaymentTerm $payment_term)
  {
        $payment_terms = PaymentTerm::paginate(10);
          return view('payment_term.edit',compact('payment_terms','payment_term'));
  }
  public function update(Request $request, PaymentTerm  $payment_term)
  {
        $this->validate($request, [
          'payment_term' => 'required|max:50',
          'no_of_days' => 'required|numeric',

        ]);

        PaymentTerm::where('payment_term_id',$payment_term->payment_term_id)->update([
          'payment_term' => $request['payment_term'],
          'no_of_days' => $request['no_of_days'],
          'updated_by' => Auth::User()->username,

          ]);

      return redirect('/payment_term/create/')->with('success-message', 'Payment Term '.$payment_term->payment_term.' is successfully Updated...!');
   }
   public function delete(Request $request)
   {
       PaymentTerm::where('payment_term_id',$request->payment_term_id)->delete();
   }
   public function search(Request $request)
{
   $this->validate($request, [
       'search' => 'required'
   ]);

   $payment_terms = PaymentTerm::
      where('payment_term', 'like', "%$request->search%")
       ->orWhere('no_of_days', 'like', "%$request->search%")
       ->paginate(10)
       ->appends(['search' => $request->search]);
   return view('payment_term.create',compact('payment_terms'));
 }

}
