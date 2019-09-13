<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class EmailController extends Controller
{
    public function usersendmail(Request $request)
    {
        $data=$request->all();
       EmailController::sendMail($data['email'],$data['subject'],$data['message']);
     }
    
    
    public function sendMail($email, $subject, $message)
    {
            
      
        $mail = null;
        $mail = new \PHPMailer(true); // notice the \  you have to use root namespace here
        try
        {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
//            $mail->SMTPDebug = 2;
            $mail->SMTPAuth = true;  // use smpt auth
//            $mail->SMTPSecure = config('MAIL_ENCRYPTION'); // or ssl
//            $mail->Host = 'mail.eworkdemo.com';
            $mail->Host = 'mail.eworkdemo.com';
            $mail->Port = 587; // most likely something different for you. This is the mailtrap.io port i use for testing. 
            $mail->Username = 'noreply@eworkdemo.com';
            $mail->Password = '1NSuZrEGNvWd';
            $mail->setFrom("noreply@eworkdemo.com", "demo_project");
            $mail->Subject = $subject;
            $mail->MsgHTML($message);
            $mail->addAddress($email);
//            $mail->send();
        }
        catch (phpmailerException $e)
        {
            return 0;
        }
        catch (Exception $e)
        {
            return 0;
        }
        return 1;
    }

}
