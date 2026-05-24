<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProdType extends Model
{
    //
    protected $table = 'ProdType';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    protected $fillable = [
        'Name'
    ];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'FK_ProdType', 'Id');
    }

}
