<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Auth;
use Hash;

class ApiController extends Controller
{
    //
    public function getUser(Request $request){

    }

    public function getContactbyId(Request $request, $id){
        $contact = Contact::where('id',$id)->get()->first();
        return response(['success' => true, 'data' => $contact, 'message' => 'Fetched'], 200);

    }

    public function deleteContactbyId(Request $request, $id){
        $contact = Contact::find($id);
        if (!$contact) {
            return response(['success' => false, 'message' => 'Contact not found'], 404);
        }
        $contact->delete();
        return response(['success' => true, 'message' => 'Contact deleted successfully'], 200);
    }

    public function editById(Request $request, $id){
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json(['error' => 'Contact not found'], 404);
        }
    
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->company = $request->input('company');
        $contact->phone = $request->input('phone');
    
        $contact->save();
    
        return response()->json(['contact' => $contact], 200);
    }

    public function login(Request $request){
        $email = $request->query('email');
        $password = $request->query('password');
        $query = User::where('email', $email)->first();

        if (!$query || !Hash::check($password, $query->password)) {
            return response(['success' => false, 'data' => [], 'message' => 'These credentials do not match our records.'], 404);
        }

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::user();
            // $token = $user->createToken('accessToken')->plainTextToken;

            return response(['success' => true, 'data' => $user, 'message' => 'User logged in Successfully'], 200);
        }
    }

    public function register(Request $request){
        try {
            //code...
            $name = $request->query('name');
            $email = $request->query('email');
            $password = $request->query('password');
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
            $token = $user->createToken('accessToken')->plainTextToken;
            return response(['success' => true, 'message' => 'Account creation successful', 'data' => $user, 'accessToken' => $token]);
        } catch (\Exception $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function addContact(Request $request){
        // $userId = $request->user()->pkUserID;
        try {
            //code...
            $contact = Contact::create([
                'user_id' => $request->input('id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'company' => $request->input('company'),
                'phone' => $request->input('phone'),
            ]);
            return response(['success' => true, 'message' => 'Account creation successful', 'data' => $contact]);
        } catch (\Exception $th) {
            return $th->getMessage();
            //throw $th;
        }
    }

    public function getContacts(Request $request){
        $query = Contact::where('user_id',$request->input('id'));
        if($request->has('q')){
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('company', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }
        $contacts = $query->get();
        return response(['success' => true, 'message' => 'Account creation successful', 'data' => $contacts]);
    }
}
