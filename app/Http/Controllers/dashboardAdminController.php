<?php

namespace App\Http\Controllers;

use App\Models\User;

class dashboardAdminController extends Controller
{
    //
    public function ListUser()
    {
        $allUsers = User::all();
        return view('user.list-user', compact('allUsers'));
    }
}
