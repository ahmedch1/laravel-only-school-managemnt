<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Parents;
use App\Pcontact;
use App\Student;
use App\Tcontact;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Aindex()
    {
        $contacts = Contact::latest()->paginate(5);
        $tcontacts = Tcontact::where("user_id", "=", Auth::id())->get();
        //$pcontacts = Tcontact::where("user_id", "=", Auth::id())->get();
        return view('contact', compact('contacts', 'tcontacts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Tindex()
    {
        $contacts = Tcontact::where("user_id", "=", Auth::id() )->get();
        return view('contact', compact('contacts'));
    }

    public function TeacherContactA()
    {
        return view('backend.contacts.teacher.admin');
    }

    public function TeacherContactP()
    {
        $parents = Parents::latest()->get();
        return view('backend.contacts.teacher.parent', compact('parents'));
    }
    public function TeacherContactS()
    {
        
        $students = Student::latest()->get();

        return view('backend.contacts.teacher.student', compact('students'));
    }

    public function AdminContactP()
    {
        $parents = Parents::latest()->get();
        return view('backend.contacts.admin.parent', compact('parents'));
    }
    public function AdminContactS()
    {
        
        $students = Student::latest()->get();

        return view('backend.contacts.admin.student', compact('students'));
    }


    public function InternauteContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        Contact::create($request->all());
        
        return redirect()->route('login')
            ->with('success', 'Your Message sended successfully');
    }



    public function TeacherContactAdmin(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);
        $currentUser = Auth::user();
        
        $msg = new Tcontact();
        $msg->user_id = 1;
        $msg->subject = "De l'enseignant ". $currentUser->name .": ". $request->input('subject');
        $msg->message = $request->input('message');
        $msg->save();

        return redirect()->route('teacher.admin')
            ->with('success', 'Your Message sended successfully');
    }

    public function TeacherContactParent(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $currentUser = Auth::user();
        
        $msg = new Tcontact();
        $msg->user_id = $request->input('user_id');
        $msg->subject = "De l'enseignant ". $currentUser->name .": ". $request->input('subject');
        $msg->message = $request->input('message');
        $msg->save();

        return redirect()->route('teacher.admin')
            ->with('success', 'Your Message sended successfully');
    }

    public function TeacherContactStudent(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $currentUser = Auth::user();
        
        $msg = new Tcontact();
        $msg->user_id = $request->input('user_id');
        $msg->subject = "De l'enseignant ". $currentUser->name .": ". $request->input('subject');
        $msg->message = $request->input('message');
        $msg->save();

        return redirect()->route('teacher.admin')
            ->with('success', 'Your Message sended successfully');
    }

    public function AdminContactParent(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $currentUser = Auth::user();
        
        $msg = new Pcontact();
        $msg->user_id = $request->input('user_id');
        $msg->subject = "De l'administration ". $currentUser->name .": ". $request->input('subject');
        $msg->message = $request->input('message');
        $msg->save();

        return redirect()->route('teacher.admin')
            ->with('success', 'Your Message sended successfully');
    }

    public function AdminContactStudent(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $currentUser = Auth::user();
        
        $msg = new Pcontact();
        $msg->user_id = $request->input('user_id');
        $msg->subject = "De l'administration ". $currentUser->name .": ". $request->input('subject');
        $msg->message = $request->input('message');
        $msg->save();

        return redirect()->route('teacher.admin')
            ->with('success', 'Your Message sended successfully');
    }
}
