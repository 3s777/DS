<?php

namespace App\Http\Controllers;

use Domain\Auth\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('content.users.index', compact('users'));
    }

    public function getUsers(Request $request) {

        if($request->input('query')) {
            $users = User::where('name','ilike', "%{$request->input('query')}%")->get();

            foreach ($users as $user) {
                $result[] = ['value' => $user->id, 'label'=> $user->name];
            }

            if($users->isEmpty()) {
                return response()->json([['value' => '', 'label'=> 'Не найдено', 'disabled' => true]]);
            }

            return response()->json($result);
        }

        $users = User::all();

        $result = [];
        foreach ($users as $user) {
            $result[] = ['value' => $user->id, 'label'=> $user->name];
        }


        if($users->isEmpty()) {
            return response()->json(['value' => '', 'label'=> 'Пусто', 'disabled' => true]);
        }

        return response()->json($result);
    }


    public function findUsers($param=null)
    {
        $users = null;

        if($param) {
            $users = User::where('name', 'LIKE', '%'.$param.'%')->get();
        }
        else {
            $users = User::all();
        }
        return response()->json($users);
    }
}
