<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutgoingMail;

class OutgoingMailController extends Controller
{

    public function index()
    {

        $outgoingMails = OutgoingMail::where('created_by', '=', \Auth::user()->creatorId())->get();

        return view('outgoing-mail.index',compact('outgoingMails'));

    }

    public function create()
    {
        return view('outgoing-mail.create');
    }

    public function store(Request $request)
    {
        if(!\Auth::user()->can('create outgoing mail')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $validator = \Validator::make(
            $request->all(), [
                'mail_no' => 'required',
                'date' => 'required|date',
                'destination' => 'required',
                'subject' => 'required',
                'status' => 'required|in:R,P',
            ]
        );
        
        if($validator->fails()) {
            
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());

        }

        $outgoingMail               = new OutgoingMail();
        $outgoingMail->mail_no      = $request->mail_no;
        $outgoingMail->date         = $request->date;
        $outgoingMail->destination       = $request->destination;
        $outgoingMail->subject      = $request->subject;
        $outgoingMail->status       = $request->status;
        $outgoingMail->created_by   = \Auth::user()->creatorId();
        $outgoingMail->save();

        return redirect()->route('outgoing-mail.index')->with('success', __('Incoming mail successfully added.'));

    }

    public function show($id)
    {
        if(!\Auth::user()->can('show outgoing mail')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        
        $outgoingMail = OutgoingMail::find($id);
        return view('outgoing-mail.view', compact('outgoingMail'));
    }
    
    public function edit($id)
    {
        $outgoingMail = OutgoingMail::where('id', '=', $id)->where('created_by', '=', \Auth::user()->creatorId())->first();
        if(!\Auth::user()->can('edit outgoing mail') || !$outgoingMail) {
            return response()->json(['error' => __('Permission denied.')], 401);
        }

        return view('outgoing-mail.edit', compact('outgoingMail'));
    }

    public function update(Request $request, $id)
    {
        $outgoingMail = OutgoingMail::where('id', '=', $id)->where('created_by', '=', \Auth::user()->creatorId())->first();
        if(!\Auth::user()->can('edit outgoing mail') || !$outgoingMail) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $validator = \Validator::make(
            $request->all(), [
                'mail_no' => 'required',
                'date' => 'required|date',
                'destination' => 'required',
                'subject' => 'required',
                'status' => 'required|in:R,P',
            ]
        );

        if($validator->fails()) {
            
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $outgoingMail->name       = $request->name;
        $outgoingMail->address    = $request->address;
        $outgoingMail->city       = $request->city;
        $outgoingMail->city_zip   = $request->city_zip;
        $outgoingMail->save();

        return redirect()->route('outgoing-mail.index')->with('success', __('Incmoing mail successfully updated.'));
    }

    public function destroy($id)
    {
        $outgoingMail = OutgoingMail::where('id', '=', $id)->where('created_by', '=', \Auth::user()->creatorId())->first();
        if(!\Auth::user()->can('delete outgoing mail') || !$outgoingMail) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $outgoingMail->delete();
        return redirect()->route('outgoing-mail.index')->with('success', __('Incoming mail successfully deleted.'));
        
    }
}
