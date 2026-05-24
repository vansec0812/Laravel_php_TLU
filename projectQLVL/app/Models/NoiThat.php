<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NoiThat extends Model
{
    //
    use HasFactory;
    protected $table = 'noitro';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'TenNoiThat',
    ];
}
