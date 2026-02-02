<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_inventaris extends Model
{
    use HasFactory;

    protected $table = "status_inventaris";
    protected $fillable = ["name"];

    public function inventaris()
    {
        return $this->hasMany(Inventaris::class, "status_id");
    }
}
