<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    //
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'StudentID';
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classRoomID', 'classRoomID');

    }
    protected $fillable = [
        'StudentID',
        'StudentName',
        'StudentEmail',
        'StudentGender',
        'classRoomID'
    ];
}
