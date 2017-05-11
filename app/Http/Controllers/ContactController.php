<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    protected  $rules = [
        'name' => ['required','min:5'],
        'company' => ['required'],
        'email' => ['required','email']
    ];
    public function table(Request $request){
//        if ($group_id = $request->get('group_id')){
//            $contact  = Contact::where('group_id',$group_id)->orderBy('id','desc')->paginate(7);
//        }else{
//            $contact = Contact::orderBy('id','desc')->paginate(7);
//        }
        $contact = Contact::where(function ($query) use ($request){
            if ($group_id = $request->get('group_id')){
                $query->where('group_id',$group_id);
            }
            if ($search = $request->get('search')){
                $query->where('name','LIKE','%'.$search.'%');
            }
        })->orderBy('id','DESC')->paginate('7');

        return view('admin.contact.TableContact',compact('contact'));
    }
    public function getCreate(){
        return view('admin.contact.CreateContact');
    }
    public function postCreate(Request $request){

        $this->validate($request,$this->rules );
        Contact::create($request->all());
        return redirect('admin/contact/table')->with('notification','Contact Saved');
    }
    public function getUpdate($id){
        $contact = Contact::find($id);
//        dd($contact);
        return view('admin.contact.EditContact',compact('contact'));
    }
    public function postUpdate($id,Request $request){
        $this->validate($request,$this->rules);
        $contact = Contact::find($id);
        $contact->update($request->all());
        return redirect('admin/contact/table')->with('notification','Contact Updated');

    }
    public function getDestroy($id){
        $contact = Contact::find($id);
        $contact->delete();
        return redirect('admin/contact/table')->with('notification','Contact Deleted');
    }
}
