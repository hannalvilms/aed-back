<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->admin != 1) {
            return response()->json([
                'success' => false,
                'message' => 'NA'
            ]);
        }
        $users = User::all();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function getUser()
    {
        $name = Auth::user()->name;
        $email = Auth::user()->email;

        return response()->json([
            'success' => true,
            'name' => $name,
            'email' => $email,
        ]);
    }

    public function destroy($id)
    {
        if (Auth::user()->admin == 1) {
            $result = auth()->user()->find($id);

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 400);
            }

            if ($result->delete()) {
                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User can not be deleted'
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pole õigusi!!!!!!'
            ], 500);
        }

    }

    public function isAdmin() {
        $admin = Auth::user()->admin;

        return response()->json([
            'success' => true,
            'isAdmin' => $admin,
        ]);
    }
}
