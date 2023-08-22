<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TestMail;

class NewEmailQueueController extends Controller
{
    
    public function index()
    {
        dispatch(new TestMail());
        dd('Mail sent to the user');
    }
}
