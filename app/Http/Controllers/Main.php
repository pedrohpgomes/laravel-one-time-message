<?php

namespace App\Http\Controllers;

use App\Mail\email_confirm_message;
use App\Mail\email_message_readed;
use App\Mail\email_read_message;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Main extends Controller
{
    // ==========================================
    public function index(){
       return view('message_form');
    }//function

    // ==========================================
    public function init(Request $request){
        
        //check if there was a post
        if(!$request->isMethod('POST')){
            return redirect()->route('main_index');
        }
        
        //validation
        $request->validate(
            [
                'text_from'    => 'required|email|max:50',
                'text_to'      => 'required|email|max:50',
                'text_message' => 'required|max:250'
            ],
            [
                'text_from.required' => 'Field "from" is required',
                'text_from.email'    => 'Field "from" must be a valid e-mail',
                'text_from.max'      => 'Field "from" must have less than 50 chars',

                'text_to.required' => 'Field "To" is required',
                'text_to.email'    => 'Field "To" must be a valid e-mail',
                'text_to.max'      => 'Field "To" must have less than 50 chars',

                'text_message.required' => 'Field "Message" is required',
                'text_message.max'      => 'Field "Message" must have less than 250 chars',
            ]
        );
        $purl_code = Str::random(32);

        $message = new Message();
        $message->send_from         = $request->text_from;
        $message->send_to           = $request->text_to;
        $message->message           = $request->text_message;
        $message->purl_confirmation = $purl_code;
        $message->save();

        //send email to sender to confirm
        Mail::to($message->send_from)->send(new email_confirm_message($purl_code));

        //update BD with datetime the confirmation e-mail was sent
        $message = Message::where('purl_confirmation',$purl_code)->first();
        $message->purl_confirmation_sent = new \DateTime();
        $message->save();

        //return the view indicating the confirmation e-mail was sent
        $data = [
            'email_address' => $request->text_from
        ];
        return view('email_confirmation_sent',$data);

    }//function

    // ==========================================
    public function confirm($purl=null){
        
        //check if purl exists
        if(empty($purl)){
            return redirect()->route('main_index');
        }

        //check if purls exists on database
        $message = Message::where('purl_confirmation',$purl)->first();

        //check if there is a message
        if($message === null){
            //view informing the error
            return view('error');
        }        

        //remove purl confirmation and create purl_read
        $purl_code = Str::random(32);
        $message->purl_confirmation = null;    
        $message->purl_read = $purl_code;
        $message->save();

        //send email to the receiver
        Mail::to($message->send_to)->send(new email_read_message($purl_code));
        $message->purl_read_sent = new \DateTime();
        $message->save();

        //return view indicating message was sent successfully
        $data = ['email_address' => $message->send_to];
        return view('message_sent',$data);

               

    }//function

    // ==========================================
    public function read($purl=null){

        //check if purl exists
        if(empty($purl)){
            return redirect()->route('main_index');
        }

        //check if purls exists on database
        $message = Message::where('purl_read',$purl)->first();

        //check if there is a message
        if($message === null){
            //view informing the error
            return view('error');
        }

        //remove the purl_read and store message_read
        $message_readed  = new \Datetime();
        $email_recipient = $message->send_to;
        $email_from      = $message->send_from;

        $message->purl_read      = null;
        $message->message_readed = $message_readed;
        $message->save();

        //send e-mail to sender confirming the message was readed
        Mail::to($email_from)->send(new email_message_readed(date_format($message_readed,"Y-m-d H:i:s"),$email_recipient));

        //display the one time message
        $data = [
            'message' => $message->message,
            'emissor' => $message->send_from
        ];
        return view('message_read',$data);

    }//function

}//class
