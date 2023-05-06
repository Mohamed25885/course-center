<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleClass extends Model
{
    use HasFactory;

    protected $guarded = ['ClassNo'];
    protected $table = 'classes';
    protected $primaryKey = 'ClassNo';

    public $timestamps = false;

    protected $casts = [
        'StartTime' => 'datetime:H:i',
        'EndTime' => 'datetime:H:i',
    ];

    public function cycle()
    {
        return $this->belongsTo(CourseCycles::class, 'CycleId');
    }
}
