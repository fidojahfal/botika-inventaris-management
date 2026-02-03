<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::with(['department', 'assignedUser:id,name', 'status'])->get();

        return response()->json([
            'message' => "Success",
            "data" => $inventaris,
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'string|required',
                'name' => 'string|required',
                'type' => 'string|required',
                'serial_number' => 'string|required',
                'spesifikasi' => 'string|required',
                'status_id' => 'integer|required|exists:status_inventaris,id',
                'assigned_user_id' => 'integer|required|exists:users,id',
                'department_id' => 'integer|required|exists:departments,id',
            ]
        );

        if ($validate->fails()) {
            return response()->json([
                "message" => "Failed to input inventaris, please check your input!",
                "errors" => $validate->errors(),
            ], 422);
        }

        $validatedData = $validate->validated();
        $inventaris = Inventaris::create($validatedData);

        return response()->json([
            "message" => 'Success',
            "data" => $inventaris,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $inventaris = Inventaris::findOrFail($id);

        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'string|required',
                'type' => 'string|required',
                'serial_number' => 'string|required',
                'spesifikasi' => 'string|required',
                'status_id' => 'integer|required|exists:status_inventaris,id',
                'assigned_user_id' => 'integer|required|exists:users,id',
                'department_id' => 'integer|required|exists:departments,id',
            ]
        );

        if ($validate->fails()) {
            return response()->json([
                "message" => "Failed to input user, please check your input!",
                "errors" => $validate->errors(),
            ], 422);
        }

        $validatedData = $validate->validated();
        $inventaris->update($validatedData);

        return response()->json([
            "message" => 'Success',
            "data" => $inventaris,
        ], 200);
    }

    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $inventaris->delete();

        return response()->json([
            "message" => 'Success',
        ], 200);
    }
}
