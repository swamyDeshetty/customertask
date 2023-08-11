<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendNewEmailJob;

class EmailController extends Controller
{
    //
    Public function sendEmail(Request $request)
    {

        /* This method will call SendEmailJob Job*/

        dispatch(new SendNewEmailJob($request));

    }
}
