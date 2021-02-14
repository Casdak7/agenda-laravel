<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $defaultUser = User::findOrFail(1);

        return view('welcome', ["defaultUser" => $defaultUser]);
    }
}
