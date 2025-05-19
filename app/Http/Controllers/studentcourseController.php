<?php

namespace App\Http\Controllers;
use App\Http\Resources\studentcourseresourcce;
use app\Models\Student;
use app\Models\Studentcourse;
use Illuminate\Http\Request;

class studentcourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentcourse=Studentcourse::all();
        return studentcourseresourcce::collection($studentcourse);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input= $request ->validate([
            'studentId'=>['requierd','exists:studentId','Id'],
            'courseId'=>['requierd','exists:courses','Id'],
            'mark'=>['requierd','numeric'],

        ]);
        Studentcourse::create($input);
        return response()->json(['message'=>'adding new course for student is added succsfully']);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Studentcourse=Studentcourse::findOrFail($id);
        return new studentcourseresourcce($Studentcourse);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input= $request ->validate([
            'studentId'=>['requierd','exists:studentId','Id'],
            'courseId'=>['requierd','exists:courses','Id'],
            'mark'=>['requierd','numeric'],

        ]);
        $Studentcourse=Studentcourse::findOrFail($id);
        return response()->json(['message'=>'course for student is updated succsfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Studentcourse=Studentcourse::findOrFail($id);
        $Studentcourse->delete();
        return response()->json(['message'=>'deleting course for student is succsfully']);
    }
}
