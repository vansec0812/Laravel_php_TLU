<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    //
    protected $table = 'Products';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    protected $fillable = [
        'Name',
        'Description',
        'FK_ProdType'
    ];
    public function prodType(): BelongsTo
    {
        return $this->belongsTo(ProdType::class, 'FK_ProdType', 'Id');
    }
}
