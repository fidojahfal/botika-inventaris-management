<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function getAllDepartments()
    {
        $departments = Department::all();

        return response()->json([
            "message" => 'Success',
            "data" => $departments
        ]);
    }
}
