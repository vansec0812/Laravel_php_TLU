<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'roomsId';
    protected $fillable = [
        'roomsId',
        'Name',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'roomsId', 'roomsId');
    }
}
