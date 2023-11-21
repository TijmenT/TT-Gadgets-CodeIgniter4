<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Twilio\Rest\Client;

class WhatsappMessage extends BaseCommand
{
    protected $group = 'Database'; // Group name to organize commands
    protected $name = 'whatsapp:message'; // The command name
    protected $description = 'Sents Whatsapp messages';

    public function run(array $params)
    {

        $sid = "ACcc35853ac68aad036eea5549df63d0a6";
        $token = "";

        $twilio = new Client($sid, $token);


        $to = "whatsapp:+31615431893";
        $from = "whatsapp:+14155238886"; 
        $body = "Voorbeeld";

        $message = $twilio->messages->create($to, [
            "from" => $from,
            "body" => $body,
        ]);

        echo "Message SID: " . $message->sid;
    }

}



