<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nguoidung extends Model
{
    use HasFactory;
    protected $table = 'nguoidung';
    public $timestamps = false;
    
    protected $primaryKey='NguoiDungID';
    //
    public function tailieu1()
    {
        return $this->belongsTo(Tailieu1::class, 'ID', 'ID');
    }
    protected $fillable = [
       'NguoiDungID',
       'TenNguoiDung',
       'GioiTinh',
       'DiaChi',
       'DienThoai',
       'Email',
       'ID',
    ];
}
