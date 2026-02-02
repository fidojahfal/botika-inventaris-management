<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_inventaris extends Model
{
    use HasFactory;

    protected $table = "type_inventaris";
    protected $fillable = ["name"];

    public function inventaris(){
        return $this->hasMany(Inventaris::class, 'type_id');
    }
}
