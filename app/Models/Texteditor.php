<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Texteditor extends Model
{
    use HasFactory;

    protected $table = 'texteditor';          // ชื่อตาราง
    protected $primaryKey = 'texteditor_id';   // primary key

     public function scopeActive($query)
    {
        return $query->where('texteditor_display', 'A');
    }

}
