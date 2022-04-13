<?php

namespace App\Utils;

use App\Utils\StringUtil;

class MailUtil
{
    public $receiver;
    public $sender;
    public $cc;
    public $bcc;
    public $subject;
    public $body;

    public function __construct(
        $receiver = [
            'name' => null,
            'email' => null
        ],
        $mailTemplate,
        $sender = [
            'name' => null,
            'email' => null
        ]
    ) {
        $this->receiver = $receiver;
        $this->sender = ($sender['email'] != null) ? 
            $sender :
            (($mailTemplate->mail_from) ? [
                'name' => $mailTemplate->from_name,
                'email' => $mailTemplate->from
            ] : [
                'name' => config('mail.from.name'),
                'email' => config('mail.from.address')
            ]);
        $this->cc = explode(',', $mailTemplate->cc);
        $this->bcc = explode(',', $mailTemplate->bcc);
        $this->subject = $mailTemplate->subject;
        $this->body = $mailTemplate->body;
    }

    public function send($type = 'html', $template = 'emails.template')
    {
        try {
            if($type === 'html') {
                \Mail::send($template, ['body' => $this->body], function($message) {
                    $message->to(
                        $this->receiver['email'],
                        $this->receiver['name']
                    );
                    $message->subject($this->subject);
                    $message->from(
                        $this->sender['email'],
                        $this->sender['name']
                    );
                });
            } else {
                $footer = '

========================
'.config('app.name').'
'.\Lang::get('common.info.brand-tagline').'
'.config('app.url').'
========================
';
                \Mail::raw($this->body.$footer, function($message) {
                    $message->to(
                        $this->receiver['email'],
                        $this->receiver['name']
                    );
                    $message->subject($this->subject);
                    $message->from(
                        $this->sender['email'],
                        $this->sender['name']
                    );
                });
            }
        } catch(\Exception $e) {
            \Log::error($e);
            return false;          
        }
            
        return true;
    }
}