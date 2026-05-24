<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;  

use Illuminate\Database\Eloquent\Model;

class VatLieu extends Model
{
    //
     use HasFactory;
    protected $table = 'vatlieu';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'TenVatLieu',
    ];
}
