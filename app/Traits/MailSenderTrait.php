<?php


namespace App\Traits;


use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

/**
 * Description of MailSender
 *
 * @author Ikhtiar
 *
 * Trait MailSenderTrait
 * @package App\Traits
 */

trait MailSenderTrait
{
    public function sendEmail($toAddress, Mailable $mailable)
    {
        try {
            Mail::to($toAddress)->send($mailable);
        } catch (\Exception $ex) {
            Log::error($ex);
        }
    }
}