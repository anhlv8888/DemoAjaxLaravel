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
    public function  __construct(){
        $this->middleware('auth');
    }
    public function table(Request $request){
//        \DB::enableQueryLog();
//        listGroups($request->user()->id);
//        dd(\DB::getQueryLog());
        $contact = Contact::where(function ($query) use ($request){
            // filter by current user
//            dd($request->user()->id);
            $query->where("user_id",$request->user()->id);
            if ($group_id = $request->get('group_id')){
                $query->where('group_id',$group_id);
            }
            if ($search = $request->get('search')){
//                dd($search);
                $keyword = '%'. $search .'%';
                $query->orWhere('email','LIKE',$keyword);
                $query->orWhere('name','LIKE',$keyword);
                $query->orWhere('company','LIKE',$keyword);

            }
        })->orderBy('id','DESC')->paginate('7');

        return view('admin.contact.TableContact',compact('contact'));
    }
    public function getCreate(){
        return view('admin.contact.CreateContact');
    }
    public function postCreate(Request $request){

        $this->validate($request,$this->rules );
//        Contact::create($request->all());
        $request->user()->contacts()->create($request->all());
        return redirect('admin/contact/table')->with('notification','Contact Saved');
    }
    public function getUpdate($id){
        $contact = Contact::findOrFail($id);
        $this->authorize('modify',$contact);
        return view('admin.contact.EditContact',compact('contact'));
    }
    public function postUpdate($id,Request $request){
        $this->validate($request,$this->rules);
        $contact = Contact::findOrFail($id);
        $this->authorize('modify',$contact);
        $contact->update($request->all());
        return redirect('admin/contact/table')->with('notification','Contact Updated');

    }
    public function getDestroy($id){
        $contact = Contact::findOrFail($id);
        $this->authorize('modify',$contact);
        $contact->delete();
        return redirect('admin/contact/table')->with('notification','Contact Deleted');
    }
    public function autocomplete(Request $request){
        if ($request->ajax()) {
            return Contact::select(['id', 'name as value'])->where(function ($query) use ($request) {
                if ($search = $request->get("search")) {
                    $keyword = '%' . $search . '%';
                    $query->orWhere('name', 'LIKE', $keyword);

                }
            })->orderBy('name', 'desc')
                ->take(5)
                ->get();
        }
    }
}
