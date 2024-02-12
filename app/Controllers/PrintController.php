<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class PrintController extends BaseController
{
    public function index()
    {
        // Set the necessary headers for a successful response
        header('X-PrintNode-Webhook-Status: OK');
        http_response_code(200); // Set HTTP status code to 200 (OK)

        // Optional: Capture and log the incoming webhook data for inspection
        $requestBody = file_get_contents('php://input');
        // Log the body to a file for debugging purposes
        file_put_contents('webhook_requests.log', date('Y-m-d H:i:s') . " - Received webhook: " . $requestBody . "\n", FILE_APPEND);

        echo "Webhook received and processed successfully.";
        die();
    }

    
}
