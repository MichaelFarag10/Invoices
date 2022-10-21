<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Invoices extends Model
{
    use HasFactory;
    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function sectionm(){
        return $this->belongsTo(Sections::class,'section_id');
    } 
 

}
