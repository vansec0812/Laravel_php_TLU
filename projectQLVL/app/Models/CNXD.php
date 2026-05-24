<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CNXD extends Model
{
    //
    use HasFactory;
    protected $table = 'cnxd';
    public $timestamps = false;
    
    protected $primaryKey='CNID';
    public function vatlieu()
    {
        return $this->belongsTo(VatLieu::class, 'ID', 'ID');
    }

     protected $fillable = [
       'CNID',
       'Name',
       'GioiTinh',
       'Email',
       'ID',
    ];
}
