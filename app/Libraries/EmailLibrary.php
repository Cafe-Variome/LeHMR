<?php

namespace App\Libraries;

use CodeIgniter\Email\Email;

class EmailLibrary
{
    protected $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();
    }

    public function sendAccessLink($to,$name,$accessLink)
    {
        $subject = 'Your Access Link';
        $message = view('email/accesslink', ['accessLink' => $accessLink,'userName'=>$name]);

        $config['protocol'] = 'ssmtp';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        // $config['smtp_host'] = 'ssl://ssmtp.gmail.com';
        $config['SMTPUser'] = 'LeHMR@leicester.ac.uk';
        $config['SMTPPass'] = '';
        $config['SMTPPort'] = '465';
        $config['mailType'] = 'html';
        $this->email->initialize($config);

        $this->email->setTo($to);
        $this->email->setFrom('LeHMR@leicester.ac.uk', 'LeHMR');
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        if ($this->email->send()) {
            return true;
        } else {
            // Log error
            log_message('error', $this->email->printDebugger(['headers']));
            return false;
        }
    }
    public function sendApprovalLink()
    {
        $subject = 'LeHMR Approval Link';
        $name = 'Moderator';
        $accessLink = 'https://www567.lamp.le.ac.uk/LeHMR_Modifier/';
        $message = view('email/approval', ['accessLink' => $accessLink,'userName'=>$name]);

        $email = 'ur13@leicester.ac.uk';

        $config['protocol'] = 'ssmtp';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        // $config['smtp_host'] = 'ssl://ssmtp.gmail.com';
        $config['SMTPUser'] = 'LeHMR@leicester.ac.uk';
        $config['SMTPPass'] = '';
        $config['SMTPPort'] = '465';
        $config['mailType'] = 'html';
        $this->email->initialize($config);

        $this->email->setTo($email);
        $this->email->setFrom('LeHMR@leicester.ac.uk', 'LeHMR');
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        if ($this->email->send()) {
            return true;
        } else {
            // Log error
            log_message('error', $this->email->printDebugger(['headers']));
            return false;
        }
    }
}
