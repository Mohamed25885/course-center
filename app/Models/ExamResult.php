<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;


    protected $guarded = ['GradeId'];
    protected $table = 'examsgrades';
    protected $primaryKey = 'GradeId';

    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentId', 'StudentId');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'TestNo', 'TestNo')->withDefault();
    }
}
