<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "inventaris";
    protected $fillable = ["id", "name", "type_id", "serial_number", "spesifikasi", "status_id", "assigned_user_id", "department_id"];

    public function type()
    {
        return $this->belongsTo(type_inventaris::class, "type_id");
    }

    public function status()
    {
        return $this->belongsTo(Status_inventaris::class, "status_id");
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, "assigned_user_id");
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
