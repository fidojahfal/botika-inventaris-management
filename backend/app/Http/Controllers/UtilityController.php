<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\Status_inventaris;
use App\Models\User;
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

    public function getAllPositions()
    {
        $positions = Position::all();

        return response()->json([
            "message" => 'Success',
            "data" => $positions
        ]);
    }

    public function getAllStatusInventaris()
    {
        $status = Status_inventaris::all();

        return response()->json([
            "message" => 'Success',
            "data" => $status
        ]);
    }

    public function getAssignedUser()
    {
        $assignedUser = User::all(['id', 'name']);

        return response()->json([
            "message" => 'Success',
            "data" => $assignedUser
        ]);
    }
}
