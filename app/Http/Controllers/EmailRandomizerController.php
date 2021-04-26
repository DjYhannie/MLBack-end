<?php

namespace App\Http\Controllers;

use App\Models\EmailRandomizer;
use Illuminate\Http\Request;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;

class EmailRandomizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//query to get all emails in the database
    public function getAllMails()
    {
        $user = Auth::user();
        $emails = DB::table('users')->select('id','email')->get();
        return response()->json($emails);
    }


    //query to get all selected emails and randomize
    public function selectedMails(Request $request)
    {
        $user = Auth::user();
        $emails =  EmailRandomizer::randomizedEmails($request);
        $randomizedEmail = EmailRandomizer::create([
            "user_id" => $user->id,
            "emails" => json_encode($emails)
        ]);
        return response()->json($randomizedEmail);
    }

    public function sendEmail()
    {
        $user = Auth::user();
       $details = [
           'title' => " Title: Email Test Connection",
           'body' => "Body: This is a test"
       ];

       Mail::to("rhea0951@gmail.com")->send(new Email($details));
       return "Email Sent";
    }


}
