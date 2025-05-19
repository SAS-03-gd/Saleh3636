<?php

namespace App\Http\Controllers;

use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students=Student::all();
        return response()->json(['data'=>$students]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string'],
            'no'=>['required','unique:students'],
            'email'=>['required','email','Unique:students'],
            'password'=>['required',],
            'Image'=>['nullable','image','mimes:png,jpg,jpeg']
        ]);
        $studentdata=$request ->except('image');
        if($request->hasFile('image')){
            $image=$request->file('image');
           $path=$image->store('students','public');
           $studentdata['imgUgl;']= Storage::url($path);
        }
        Student:: create($studentdata);
        return response()->json(['message'=>'student created succesfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $students=Student::findOrFail($id);
        return response()->json(['data'=>$students]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>['required','string'],
            'no'=>['required','unique:students'],
            'email'=>['required','email','Unique:students'],
            'password'=>['required',],
            'Image'=>['nullable','image','mimes:png,jpg,jpeg']
        ]);
        $studentdata=$request ->Expect('image');
        if($request->hasFile('image')){
            $image=$request->file('image');
           $path=$image->store('students','public');
           $studentdata['imgUgl;']=Storage::url( $path);
        }
        $student=Student::findOrFail($id);
        $student->update($studentdata);
        return response()->json(['message'=>'student updated succesfully']);
    }

    public function destroy(string $id)
    {
        $student=Student::findOrFail($id);
        $student->Isactive=0;
        $student->dissmissed=1;
        $student->save();
        return response()->json(['message'=>'student dissmised succesfully']);
    }

    public function graduated(string $id)
    {
        $student=Student::findOrFail($id);
        $student->Isactive=0;
        $student->graduated=1;
        $student->save();
        return response()->json(['message'=>'student graduated succesfully']);
    }

}
