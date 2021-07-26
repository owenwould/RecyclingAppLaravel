<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecycledItem extends Model
{
    use HasFactory;
    public $timestamps = False;
    protected $table = 'recycleditems';
}
