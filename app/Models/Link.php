<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'href', 'id_group', 'public', 'code'];

    public function group(){
        return $this->belongsTo(Group::class, 'id_group');
    }
}
