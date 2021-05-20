<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(User::all(), 200);
    }

    /**
     * Display a sinfle resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::find($id);
        if(is_null($user)) {
            return response()->json(['message' => 'User Not Found'], 404);
        }
        return response()->json($user::find($id), 200);
    }

    /**
     * Store the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return response(User::all(), 201);
    }

    /**
     * Updating the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::find($id);
        if(is_null($user)) {
            return response()->json(['message' => 'User Not Found'], 404);
        }
        $user->update($user->all());
        return response($user, 200);
    }

    /**
     * Deleting the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::find($id);
        if(is_null($user)) {
            return response()->json(['message' => 'User Not Found'], 404);
        }
        $user->delete();
        return response()->json(null, 204);
    }
}
