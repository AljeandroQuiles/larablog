<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactImage;
use App\Helpers\CustomUrl;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('rol.admin'); NO FUNCIONA
 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $contacts = Contact::orderBy('created_at','desc')->paginate(2);



        return view('dashboard.contact.index', ['contacts' => $contacts]);
    }



   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
      
       // $contact = Contact::findOrFail($id);
        return view('dashboard.contact.show', ["contact" => $contact]); 
    
    }

    public function destroy(Contact $contact)
    {
       $contact->delete();
       return back()->with('status', 'Contact eliminado con exito');

    }
}
