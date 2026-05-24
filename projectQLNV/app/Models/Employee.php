<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    //
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'Id';
    public function room()
    {
        return $this->belongsTo(Room::class, 'roomsId', 'roomsId');

    }
    protected $fillable = [
        'Id',
        'Name',
        'Birthday',
        'roomsId',
    ];
}
