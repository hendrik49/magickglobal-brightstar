<?php

namespace App\Http\Controllers;

use App\Models\IncomingMail;
use Illuminate\Http\Request;

class IncomingMailController extends Controller
{
    public function index()
    {

        $incomingMails = IncomingMail::where('created_by', '=', \Auth::user()->creatorId())->get();

        return view('incoming-mail.index',compact('incomingMails'));

    }

    public function create()
    {
        return view('incoming-mail.create');
    }

    public function store(Request $request)
    {
        if(!\Auth::user()->can('create incoming mail')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $validator = \Validator::make(
            $request->all(), [
                'mail_no' => 'required',
                'date' => 'required|date',
                'source' => 'required',
                'subject' => 'required',
                'status' => 'required|in:R,P',
            ]
        );
        
        if($validator->fails()) {
            
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());

        }

        $incomingMail               = new IncomingMail();
        $incomingMail->mail_no      = $request->mail_no;
        $incomingMail->date         = $request->date;
        $incomingMail->source       = $request->source;
        $incomingMail->subject      = $request->subject;
        $incomingMail->status       = $request->status;
        $incomingMail->created_by   = \Auth::user()->creatorId();
        $incomingMail->save();

        return redirect()->route('incoming-mail.index')->with('success', __('Incoming mail successfully added.'));

    }

    public function show($id)
    {
        if(!\Auth::user()->can('show incoming mail')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        
        $incomingMail = IncomingMail::find($id);
        return view('incoming-mail.view', compact('incomingMail'));
    }
    
    public function edit($id)
    {
        $incomingMail = IncomingMail::where('id', '=', $id)->where('created_by', '=', \Auth::user()->creatorId())->first();
        if(!\Auth::user()->can('edit incoming mail') || !$incomingMail) {
            return response()->json(['error' => __('Permission denied.')], 401);
        }

        return view('incoming-mail.edit', compact('incomingMail'));
    }

    public function update(Request $request, $id)
    {
        $incomingMail = IncomingMail::where('id', '=', $id)->where('created_by', '=', \Auth::user()->creatorId())->first();
        if(!\Auth::user()->can('edit incoming mail') || !$incomingMail) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $validator = \Validator::make(
            $request->all(), [
                'mail_no' => 'required',
                'date' => 'required|date',
                'source' => 'required',
                'subject' => 'required',
                'status' => 'required|in:R,P',
            ]
        );

        if($validator->fails()) {
            
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $incomingMail->name       = $request->name;
        $incomingMail->address    = $request->address;
        $incomingMail->city       = $request->city;
        $incomingMail->city_zip   = $request->city_zip;
        $incomingMail->save();

        return redirect()->route('incoming-mail.index')->with('success', __('Incmoing mail successfully updated.'));
    }

    public function destroy($id)
    {
        $incomingMail = IncomingMail::where('id', '=', $id)->where('created_by', '=', \Auth::user()->creatorId())->first();
        if(!\Auth::user()->can('delete incoming mail') || !$incomingMail) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $incomingMail->delete();
        return redirect()->route('incoming-mail.index')->with('success', __('Incoming mail successfully deleted.'));
        
    }
}
