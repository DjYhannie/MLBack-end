<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Forms;
// use Dotenv\Validator;
use App\Models\EmailRandomizer;
use App\Mail\Email;
use App\Notifications\EmailNotif;



class EmailRandomizerController extends Controller
{
    use Notifiable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

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

        $randomizedEmail->emails = json_decode($randomizedEmail->emails);
        return response()->json($randomizedEmail);
    }



    public function addDataForms(Request $request)
    {
        // $user = Auth::user();
        // dd($user);
        $validator = Validator::make($request->all(),[
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required',
            'category1' => 'required',
            'category2' => 'required',
            'category3' => 'required',
            'category4' => 'required',
            'category5' => 'required',
            'category6' => 'required',
            'category7' => 'required',
            'category8' => 'required',
            'category9' => 'required',
            'category10' => 'required'
        ]);

        if ($validator ->fails()) {
            return response()->json([
                'status_code'=>400,
                'message'=>'Bad Request',
                $validator->errors()]);
        }

        $response = [];
        try{
            $data = Forms::create($request->all());
            $response['status_code'] = 200;
            $response['message'] = 'success';
            $response['data'] = $data;
        } catch (\Exception $e) {
            $response['status_code'] = 400;
            $response['message'] = $e->getMessage();
            $response['data'] = null;
        }

        return response($response);
    }



    //query to send mail --not yet final
    // public function sendEmail()
    // {
    //     $user = Auth::user();
    //    $details = [
    //        'title' => " Title: Email Test Connection",
    //        'body' => "Body: This is a test"
    //    ];

    //    $emails = $this->selectedMails();
    //    Mail::mailer('sendgrid')

    //         ->to($emails)
    //         ->send(new Email($details));
    //         return "done";

    //    Mail::to("rhea0951@gmail.com")->send(new Email($details));
    //    return "Email Sent";
    // }

    public function sendTestNotification()
    {
        $user = Auth::user();
        // $user = User::first();

        $emailData = [
            'greeting' => 'Greeting test',
            'body' => 'This a test',
            'emailText' => 'Please fill up',
            'url' => url('/'),
            'thankyou' => 'You are mine'
        ];

        // $user->notify(new EmailNotif($emailData));
        Notification::send($user, new EmailNotif($emailData));

        dd('$emailData');
    }

}
