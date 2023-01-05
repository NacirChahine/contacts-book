<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = auth()->user()->contacts();
        return view('dashboard', compact('contacts'));
    }
    public function add()
    {
    	return view('add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',  // |digits:11
]);
    	$contact = new Contact();
    	$contact->first_name = $request->first_name;
    	$contact->last_name = $request->last_name;
    	$contact->email = $request->email;
    	$contact->phone = $request->phone;
        $contact->user_id = auth()->user()->id;

    	$contact->save();
    	return redirect('/dashboard'); 
    }
    public function edit(Contact $contact)
    {

    	if (auth()->user()->id == $contact->user_id)
        {            
                return view('edit', compact('contact'));
        }           
        else {
             return redirect('/dashboard');
         }            	
    }

    public function update(Request $request, Contact $contact)
    {
    	if(isset($_POST['delete'])) {
    		$contact->delete();
    		return redirect('/dashboard');
    	}
    	else
    	{
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',  // |digits:11
        ]);
            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;

	    	$contact->save();
	    	return redirect('/dashboard'); 

            // $this->validate($request, [
            //     'first_name' => 'required',
            //     'last_name' => 'required',
            //     'email' => 'required|email',
            //     'phone' => 'required|digits:10|numeric',
            // ]);
            // $contact = new Contact();
            // $contact->first_name = $request->first_name;
            // $contact->last_name = $request->last_name;
            // $contact->email = $request->email;
            // $contact->phone = $request->phone;
            // $contact->user_id = auth()->user()->id;
    
            // $contact->save();
            // return redirect('/dashboard'); 
            }    	
    }
}