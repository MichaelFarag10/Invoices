<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'description',
        'section_id'
    ];

    public function sectionm(){
        return $this->belongsTo(Sections::class,'section_id');
    } 

}
