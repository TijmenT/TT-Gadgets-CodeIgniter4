<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class WhatsappMessageMeta extends BaseCommand
{
    protected $group = 'Database'; // Group name to organize commands
    protected $name = 'whatsapp:messagemeta'; // The command name
    protected $description = 'Sents Whatsapp messages';

    public function run(array $params)
    {
        $token = ''; 
        $url = 'https://graph.facebook.com/v17.0/173806292481503/messages';

        $headers = [
            'Authorization: Bearer '. $token,
            'Content-Type: application/json'
        ];

        $postData = [
            'messaging_product' => 'whatsapp',
            'to' => '31615431893',
            'type' => 'template',
            'template' => [
                'name' => 'hello_world',
                'language' => ['code' => 'en_US']
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return $error_msg;
        }

        curl_close($ch);
        return $response;
    }

}



