<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Ticket;

use App\TicketCategory;

use App\Master;

use App\User;

use App\Priority;

use App\Contact;

use App\Message;

use App\File;

class TicketController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
    public function create()
    {
        $id = Ticket::max('ticket_id');
        $ticket_no = $id + 1;
        $length = strlen($ticket_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++)
        {
            $ticket_no = '0'.$ticket_no;
        }
        $tickets = Ticket::paginate(10);
        $categories = TicketCategory::get();
        $users = User::get();
        $ticket_status = Master::where('master_name','Ticket Status')->get();
        $priorities = Priority::paginate(10);
        $contacts = Contact::paginate(10);
        return view('ticket.create',compact('tickets','ticket_no','users','ticket_status','priorities','contacts','categories'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'ticket_no' => 'required|max:50',
            'ticket_date' => 'required|date',
            'category_id' => 'required',
            'priority_id' => 'required',
            'contact_id' => 'required',
            'user_id' => 'required',
            'message' => 'required|max:2550',
            'note' => 'max:2550',

        ]);

        $ticket = Ticket::create([
            'ticket_no' => $request['ticket_no'],
            'ticket_date'=> date("Y-m-d", strtotime($request['ticket_date'])),
            'category_id' => $request['category_id'],
            'priority_id' => $request['priority_id'],
            'contact_id' => $request['contact_id'],
            'user_id' => $request['user_id'],
            'note' => $request['note'],
            'status' => 'Open',  
            'checked' => 0,
            'read_status' => 0,
            'created_by' => Auth::User()->username,
        ]);
        
        Message::create([
            'ticket_id' => $ticket->ticket_id,
            'message' => $request->message,
            'created_by' => Auth::User()->username,
        ]);

       
        if($request->hasFile('file'))
        { 
            $docs = $request->file('file');
            $name='';
            $i = 0;
            
            foreach($docs as $doc) 
            {
                $filename = $i.$ticket->ticket_id.date('Ymdhis').'.'. $doc->getClientOriginalExtension();
                $doc->storeAs('File',$filename);
                $i = $i+1;  
            }
            File::create([
                'ticket_id' => $ticket->ticket_id,
                'file' => $filename,
                'created_by' => Auth::User()->username,
            ]);
        }
    
        return redirect('/ticket/display?status=All')->with('success-message', 'Ticket '.$ticket->ticket_no.' is successfully created...!');
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $this->validate($request, [
            'message' => 'required|max:2550',
        ]);
        Message::create([
            'ticket_id' => $ticket->ticket_id,
            'message' => $request->message,
            'message_type' => 'Reply',
            'created_by' => Auth::User()->username,
        ]);
        return redirect()->back()->with('success-message', 'Ticket '.$ticket->ticket_no.' is successfully updated...!');
    }
    public function view(Request $request,Ticket $ticket)
    {
        Ticket::where('ticket_id',$ticket->ticket_id)->update([
            'read_status' => '1',
        ]);
        $categories = TicketCategory::get();
        $message = Message::where([['ticket_id',$ticket->ticket_id],['message_type','Default']])->first();
        $messages = Message::where([['ticket_id',$ticket->ticket_id],['message_type','Reply']])->get();
        $files = File::where('ticket_id',$ticket->ticket_id)->get();
        $priorities = Priority::get();
        $status = $request->status;
        return view('ticket.view',compact('ticket','messages','message','files','categories','priorities','status'));
    }
    
    public function edit(Ticket $ticket)
    {
        $categories = TicketCategory::get();
        $tickets = Ticket::paginate(10);
        $categories = TicketCategory::paginate(10);
        $users = User::paginate(10);
        $ticket_status = Master::where('master_name','Ticket Status')->get();
        $priorities = Priority::paginate(10);
        $priorities = Priority::paginate(10);
        $contacts = Contact::paginate(10);
        return view('ticket.edit',compact('tickets','categories','users','ticket_status','priorities','contacts','ticket'));
    }
    public function update(Request $request, Ticket  $ticket)
    {
        $this->validate($request, [
        'ticket_no' => 'required|max:50',
        'ticket_date' => 'required|date',
        'category_id' => 'required|numeric',
        'priority_id' => 'required|numeric',
        'contact_id' => 'required|numeric',
        'user_id' => 'required|numeric',
        'message' => ' ',
        'note' => ' ',
        
        ]);

        Ticket::where('ticket_id',$ticket->ticket_id)->update([
        'ticket_no' => $request['ticket_no'],
        'ticket_date'=> date("Y-m-d", strtotime($request['ticket_date'])),
        'category_id' => $request['category_id'],
        'priority_id' => $request['priority_id'],
        'contact_id' => $request['contact_id'],
        'user_id' => $request['user_id'],
        'status' => 'Open', 
        'checked' => 0, 
        'read_status' => 0,  
        'note' => $request['note'],
        'updated_by' => Auth::User()->username,

            ]);
        
        $message = Message::where('message_type','Default')->first();
        Message::where('ticket_id',$ticket->ticket_id)->update([
            'ticket_id' => $ticket->ticket_id,
            'message' => $request->message,
            'updated_by' => Auth::User()->username,
        ]);
    
        if($request->hasFile('file'))
        {
            $docs = $request->file('file');
            $name='';
            $i = 0;
       
            foreach ($docs as $doc) 
            {
                $filename = $i.$ticket->ticket_id.date('Ymdhis').'.'. $doc->getClientOriginalExtension();
                $doc->storeAs('File',$filename);
                $i = $i+1;
                
                File::create([
                    'ticket_id' => $ticket->ticket_id,
                    'file' => $filename,
                    'updated_by' => Auth::User()->username,
                ]);
            }
        }

        return redirect('/ticket/display?status=All')->with('success-message', 'Ticket '.$ticket->ticket_no.' is successfully updated...!');

    }

    public function display(Request $request)
    {
        $status = $request->status;
        $category_id = $request->category;
        $priority_id = $request->priority;
        if($request->status=='All')
        {
            if($category_id=='')   
            {
                if($priority_id=='')
                {
                    $tickets = Ticket::where('checked',0)->orderBy('ticket_id','DESC')
                    ->paginate(10)
                    ->appends(['status' => $status]);
                }
                else
                {
                    $tickets = Ticket::where([['checked',0],['priority_id',$priority_id]])->orderBy('ticket_id','DESC')
                    ->paginate(10)
                    ->appends(['status' => $status])
                    ->appends(['priority' => $priority_id]);
                }
                
            }
            else
            {
                $tickets = Ticket::where([['checked',0],['category_id',$category_id]])->orderBy('ticket_id','DESC')
                ->paginate(10)
                ->appends(['status' => $status])
                ->appends(['category' => $category_id]);
                
            }

            
        }
        else
        {
            if($category_id=='')
            {
                if($priority_id=='')
                {
                   $tickets = Ticket::where([['checked',0],['status',$request->status]])->orderBy('ticket_id','DESC')
                    ->paginate(10)
                    ->appends(['status' => $status]);

                }
                else
                {
                    $tickets = Ticket::where([['checked',0],['status',$request->status],['priority_id',$priority_id]])->orderBy('ticket_id','DESC')
                    ->paginate(10)
                    ->appends(['status' => $status])
                    ->appends(['priority' => $priority_id]);

                }
                
            }
            else
            {
                $tickets = Ticket::where([['checked',0],['status',$request->status],['category_id',$category_id]])->orderBy('ticket_id','DESC')
                ->paginate(10)
                ->appends(['status' => $status])
                ->appends(['category' => $category_id]);
            }
            
        }
        $categories = TicketCategory::get();
        $priorities = Priority::get();
        return view('ticket.display',compact('tickets','ticket','categories','status','ticket_categories','priorities'));
    }

    public function multiple_delete(Request $request)
    {
        $this->validate($request, [
            'checked' => 'required',
        ]);
        
        foreach($request->checked as $checked)
        {
            Ticket::where('ticket_id',$checked)->update([
                'checked' => '1',
                'updated_by' => Auth::User()->username,

            ]);
        }

        return redirect('/ticket/display?status=All');
    }
    
    public function close(Request $request,Ticket $ticket)
    {   
    
        Ticket::where('ticket_id',$ticket->ticket_id)->update([
           'status' => 'Close',
           'updated_by' => Auth::User()->username,
       ]);
        
        return redirect('/ticket/display?status=Close')->with('success-message','Ticket is successfully closed');
    }
    public function pending(Request $request,Ticket $ticket)
    {   
    
        Ticket::where('ticket_id',$ticket->ticket_id)->update([
           'status' => 'Pending',
           'updated_by' => Auth::User()->username,
       ]);
        
        return redirect('/ticket/display?status=Pending')->with('success-message','Ticket is Successfully Moved to Pending');
    }
    public function reopen(Request $request,Ticket $ticket)
    {   
    
        Ticket::where('ticket_id',$ticket->ticket_id)->update([
           'status' => 'Reopen',
           'updated_by' => Auth::User()->username,
       ]);
        
        return redirect('/ticket/display?status=Reopen')->with('success-message','Ticket is successfully Reopened');
    }
    public function multiple_pending(Request $request)
    {
        $this->validate($request, [
            'checked' => 'required',
        ]);
        
        foreach($request->checked as $checked)
        {
            Ticket::where('ticket_id',$checked)->update([
                'checked' => 'Pending',
                'updated_by' => Auth::User()->username,

            ]);
        }

        return redirect('/ticket/display');
    }
    public function multiple_reopen(Request $request)
    {
        $this->validate($request, [
            'checked' => 'required',
        ]);
        
            Ticket::where('ticket_id',$checked)->update([
                'checked' => '1',
                'updated_by' => Auth::User()->username,

            ]);
        

        return redirect('/ticket/display');
    }
   
    public function search(Request $request)
    {
        $data = explode(',',$request->field);
        $status = $request->status;
        $categories = TicketCategory::get();
        $priorities = Priority::get();
            $this->validate($request, [
                'search' => 'required'
            ]);
            if($status=='All')
            {
                if($data[1]=='f')
                {   
                    
                    $tickets = Ticket::where('checked',0)->where($data[0],'LIKE',"%$request->search%")
                        ->paginate(10)
                        ->appends(['field' => $request->field])
                        ->appends(['search' => $request->search])
                        ->appends(['status' => $status]);
                        
                }
                else
                {
                    $tickets = Ticket::where('checked',0)->whereHas($data[2], function($query) use($request,$data){
                        $query->where($data[0],'LIKE',"%$request->search%");
                    })
                        ->paginate(10)
                        ->appends(['field' => $request->field])
                        ->appends(['search' => $request->search])
                        ->appends(['status' => $status]);
                        
                }
            }
            else
            {
                if($data[1]=='f')
                {
                    $tickets = Ticket::where('checked',0)->where('status',$status)->where($data[0],'LIKE',"%$request->search%")
                        ->paginate(10)
                        ->appends(['field' => $request->field])
                        ->appends(['search' => $request->search])
                        ->appends(['status' => $status]);
                }
                else
                {
                    $tickets = Ticket::where('checked',0)->where('status',$status)->whereHas($data[2], function($query) use($request,$data){
                        $query->where($data[0],'LIKE',"%$request->search%");
                    })
                        ->paginate(10)
                        ->appends(['field' => $request->field])
                        ->appends(['search' => $request->search])
                        ->appends(['status' => $status]);
                }
            }
       
       
        return view('ticket.display',compact('tickets','ticket','categories','status','priorities'));
    }
    public function delete(Request $request)
    {

        Ticket::where('ticket_id',$request->ticket_id)->delete();
    }
    public function edit_reply(Request $request)
    {
        $message = Message::where('message_id',$request->message_id)->first();
        return response()->json($message);
    }
    public function update_reply(Request $request, Message $message)
    {
         $this->validate($request, [  
            'reply_message' => 'required',
        ]);
        Message::where('message_id',$message->message_id)->update([
            'message' => $request->reply_message,
            'created_by' => Auth::User()->username,
        ]);
        return redirect()->back();
    }
    public function delete_reply(Request $request)
    {

        Message::where('message_id',$request->message_id)->delete();
    }
}
/*public function all( )
    {
        $tickets = Ticket::where('checked',0)->paginate(10);
        return view('ticket.all',compact('tickets'));

    }

    public function open()
    {

        if(Auth::User()->user_role=='Admin')
        {
            $tickets= Ticket::where([['status', 'Open'],['Admin', Auth::User()->user_id]])->paginate(10);
        }
        else
        {
            $tickets= Ticket::where('status', 'Open')->paginate(10);
        }
        return view('ticket.open',compact('tickets'));

    }
    
    public function update_reopen(Ticket $ticket)
    {
      Ticket::where('ticket_id',$ticket->ticket_id)->update([
           'status' => 'Open',
           'updated_by' => Auth::User()->username,
       ]);
       return redirect('/ticket/open');
    }


    
    
    public function update_close(Ticket $ticket)
    {
      Ticket::where('ticket_id',$ticket->ticket_id)->update([
           'status' => 'Closed',
           'updated_by' => Auth::User()->username,
       ]);
       return redirect('/ticket/close');
    }

    public function pending()
    {

        if(Auth::User()->user_role=='Admin')
        {
            $tickets= Ticket::where('status', 'Pending')->where('0', Auth::User()->user_id)->paginate(10);
        }
        else
        {
            $tickets= Ticket::where('status', 'Pending')->paginate(10);
        }
        return view('ticket.pending',compact('tickets'));

    }*/ 
