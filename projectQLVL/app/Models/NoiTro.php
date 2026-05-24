<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class NoiTro extends Model
{
    //
    use HasFactory;
    protected $table = 'noitro';
    public $timestamps = false;
    
    protected $primaryKey='NoiTroID';
    public function noithat()
    {
        return $this->belongsTo(NoiThat::class, 'ID', 'ID');
    }

     protected $fillable = [
       'NoiTroID',
       'Name',
       'GioiTinh',
       'Email',
       'ID',
    ];
    
}
