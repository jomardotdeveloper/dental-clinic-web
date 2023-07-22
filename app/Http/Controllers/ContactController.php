<?php

namespace App\Http\Controllers;

use App\Http\Traits\ContactTrait;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ContactTrait;

    private function validateParam()
    {
        $keys = array_keys(Contact::USER_TYPES);
        $has_param = false;
        foreach($keys as $key) {
            if(isset($_GET[$key]))
            {
                $has_param = true;
                break;
            }
        }

        if(!$has_param) {
            abort(404); 
        }
        return $key;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $key = $this->validateParam();

        return view('contacts.index', [
            'key' => $key,
            'title' => Contact::USER_TYPES[$key],
            'contacts' => Contact::where($key, true)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $key = $this->validateParam();
        return view('contacts.create', [
            'key' => $key,
            'title' => Contact::USER_TYPES[$key],
            'availabilities' => Contact::DENTIST_AVAILABILITIES
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $key = $request->key;
        $request->merge([
            $key => true
        ]);

        if($request->get('key') != 'is_patient') {
            $user = $this->createUser($request);
            if($user["status"] == "failed") {
                return redirect()->back()->with(['error'=> $user["error"]]);
            }
            $request->merge([
                'user_id' => $user["obj"]->id
            ]);
        }
        
        if($request->get('key') == 'is_dentist') {
            $request->merge([
                'dentist_availabilities' => implode(',', $request->get('dentist_availabilities'))
            ]);
        }

        $contact = $this->createContact($request);


        return redirect()->route('contacts.index', [$key => 1])->with(['success' => ['Contact successfully created!']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $key = $this->validateParam();
        return view('contacts.show', [
            'contact' => $contact,
            'key' => $key,
            'title' => Contact::USER_TYPES[$key]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $key = $this->validateParam();
        return view('contacts.edit', [
            'contact' => $contact,
            'key' => $key,
            'title' => Contact::USER_TYPES[$key],
            'availabilities' => Contact::DENTIST_AVAILABILITIES
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        if($request->has('email') ) {
            $user = $this->updateUser($request, $contact->user_id);
            if($user["status"] == "failed") {
                return redirect()->back()->with(['error'=> $user["error"]]);
            }
            
            $request->merge([
                'user_id' => $user["obj"]->id
            ]);
        }


        if($request->get('key') == 'is_dentist') {
            $request->merge([
                'dentist_availabilities' => implode(',', $request->get('dentist_availabilities'))
            ]);
        }
        $this->updateUser($request, $contact->user_id);
        
        $contact = $this->updateContact($request, $contact->id);

        
        return redirect()->route('contacts.index', [$request->key => 1])->with(['success' => ['Contact successfully updated!']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $key = $this->validateParam();

        if($contact->user_id) {
            $this->deleteUser($contact->user_id);
        }
        $this->deleteContact($contact->id);
        return redirect()->route('contacts.index', [$key => 1])->with(['success' => ['Contact successfully deleted!']]);
    }

    public function grantUserAccount(Request $request, Contact $contact)
    {
        $user = $this->createUser($request);
        if($user["status"] == "failed") {
            return redirect()->back()->with(['error'=> $user["error"]]);
        }
        $contact->update([
            'user_id' => $user["obj"]->id
        ]);
        return redirect()->route('contacts.index', ['is_patient' => 1])->with(['success' => ['Contact successfully updated!']]);
    }
}
