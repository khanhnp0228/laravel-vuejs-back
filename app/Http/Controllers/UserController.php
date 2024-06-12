<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($id) {
        return User::findOrFail($id);
    }

    public function index() {
        $users = User::
            join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select(
                'users.*',
                'departments.name as departments',
                'users_status.name as status'
            )
            ->get();
        return response()->json($users);
    }

    public function create() {
        $users_status = DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )->get();
        $departments = DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        return response()->json([
            "users_status" => $users_status,
            "departments" => $departments
        ]);
    }

    public function store(Request $request) {
//        $validated = $request->validate([
//            "status_id" => "required",
//            "username" => "required|unique:users,username",
//            "name" => "required|max:255",
//            "email" => "required|email",
//            "department_id" => "required",
//            "password" => "required|confirmed",
//        ], [
//            "status_id.required" => "Status required field.",
//
//            "username.required" => "Username required field.",
//            "username.unique" => "Username existed.",
//
//            "name.required" => "Name required field.",
//            "name.max" => "Name max length is 255 characters.",
//
//            "email.required" => "Email required field.",
//            "email.email" => "Email format incorrect.",
//
//            "department_id.required" => "Department required field.",
//
//            "password.required" => "Password required field.",
//            "password.confirmed" => "re-Password is not same Password.",
//        ]);

        $user = $request->except([
            'password',
            'password_confirmation'
        ]);
        $user["password"] = Hash::make($request["password"]);
        User::create($user);

        // Eloquent ORM
//        User::create([
//            'status_id' => $request['status_id'],
//            'username' => $request['username'],
//            'name' => $request['name'],
//            'email' => $request['email'],
//            'department_id' => $request['department_id'],
//            'password' => Hash::make($request['password']),
//        ]);

        // Query Builder
//        DB::table('users')->insert([
//            'name' => ''
//        ]);
    }

    public function edit($id) {

        $users_status = DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )->get();
        $departments = DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        $user = User::findOrFail($id);
        return response()->json([
            "user" => $user,
            "users_status" => $users_status,
            "departments" => $departments
        ]);
    }
}
