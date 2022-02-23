<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('can:admin');
    }
    
    public function findAllUsers()
    {
        return User::paginate(3);
    }
}
