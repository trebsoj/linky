<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedirectLog extends Model
{
    use HasFactory;
    protected $fillable = ['ip', 'id_link'];

    public function link(){
        return $this->belongsTo(Link::class, 'id_group');
    }
}
