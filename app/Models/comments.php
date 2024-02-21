<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $fillable=['item_id','user_id','parent_id','content','c_table'];

    function user(){
        return  $this->belongsTo(User::class);
    }
    function Book(){
        return $this->belongsTo(Books::class);
    }
}
