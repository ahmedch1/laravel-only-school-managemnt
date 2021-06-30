<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentdetailsController extends Controller
{
    public function updateStudentdetails(Request $request,Student $student)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:users,email,'.$student->user_id,
            'parent_id'         => 'required|numeric',
            'class_id'          => 'required|numeric',
            'roll_number'       => [
                'required',
                'numeric',
                Rule::unique('students')->ignore($student->id)->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                })
            ],
            'evaluation'       => [
                'required',
                'numeric',
                Rule::unique('students')->ignore($student->id)->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                })
            ],
            'gender'            => 'required|string',
            'phone'             => 'required|string|max:255',
            'dateofbirth'       => 'required|date',
            'current_address'   => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'paid'=>'required|string|max:255'
        ]);

        if ($request->hasFile('profile_picture')) {
            $profile = Str::slug($student->user->name).'-'.$student->user->id.'.'.$request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $profile);
        } else {
            $profile = $student->user->profile_picture;
        }

        $student->user()->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'profile_picture'   => $profile
        ]);

        $student->update([
            'evaluation'=>$request->evaluation,
            'note'=>$request->note
        ]);
    }
}
