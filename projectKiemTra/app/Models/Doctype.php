<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctype extends Model
{
    //
      use HasFactory;
    protected $table = '_doc_types';
    protected $primaryKey = 'Id_DocType';
    public $timestamps = false;

    protected $fillable = [
        'Name_DocType',
    ];
}
