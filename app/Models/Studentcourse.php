<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studentcourse extends Model
{
    protected $fillable=[
        'student_id',
        'course_id',
        'mark'
    ];

    public function student()   
    {
        return $this->belongsTo(Student::class,"studentId","Id");
    }

    public function course()   
    {
        return $this->belongsTo(Course::class,"courseId","Id");
    }
    
    protected $appends=['avg','aa'];
    public function getavgattribute()
    {
        $count=Studentcourse::where('studentId',$this->studentId)->count();
        $sum=Studentcourse::where('studentId',$this->studentId)->sum('mark');
        if ($count>0)
        {
        return $sum/$count;
        }
        else
        {
            return 0;
        }

    }

    
}
