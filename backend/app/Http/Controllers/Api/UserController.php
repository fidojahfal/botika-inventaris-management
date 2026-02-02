<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('department')->get();

        return response()->json([
            'message' => "Success",
            "data" => $users,
        ]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'string|required',
                'jabatan' => 'string|required',
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
        $user = User::create($validatedData);

        return response()->json([
            "message" => 'Success',
            "data" => $user,
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
