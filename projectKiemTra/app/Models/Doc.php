<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doc extends Model
{
    //
    use HasFactory;
    protected $table = '_docs';
    public $timestamps = false;
    
    protected $primaryKey='Id_Doc';
    public function vatlieu()
    {
        return $this->belongsTo(Doctype::class, 'Id_DocType', 'Id_DocType');
    }

     protected $fillable = [
       'Id_Doc',
       'Name_Doc',
       'Author',
       'Des',
       'Id_DocType',
    ];
}
