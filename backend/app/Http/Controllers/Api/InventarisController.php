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
        $inventaris = Inventaris::with(['department', 'assignedUser:id,name', 'status', 'type'])->get();

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
                'type_id' => 'integer|required|exists:type_inventaris,id',
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
