<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;


class coursecontroller extends Controller
{
    public function index()
    {
        $courses=Course::all();
        return response()->json(['data'=>$courses]);
    }
    public function show(string $Id)
    {
        $course=Course::findOrFail($Id);       
        return response()->json(['data'=>$course]);
    }

    public function store(request $request)
    {
        dd($request);
        $input=$request->validate([
            'name'=>['required','string'],
            'symbol'=>['required','unique:courses'],
            'unit'=>['required','numeric']



        ]);
        Course::create($input);
        return response()->json(['message'=>'course created succesfully']);
    }
    public function update(Request $request, string $id) {
        $input=$request->validate([
            'name'=>['required','string'],
            'symbol'=>['required','unique:courses'],
            'unit'=>['required','numeric']
        ]);
        $course=Course::findOrFail($id);
        $course->update($input);
        return response()->json(['message'=>'course updated succesfully']);
    }
    public function destroy(string $id){
        $course=Course::findOrFail($id);
        $course->delete();
        return response()->json(['message'=>'course deleted succesfully']);
    }
}
