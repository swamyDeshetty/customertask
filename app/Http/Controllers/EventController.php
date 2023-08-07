<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Event\UserCreated;

class EventController extends Controller
{
    //

    public function index()
    {
        event(new UserCreated('Your account has created'));
    }
}
