<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
class MyFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {

        $request = service('request');
        $uri = $request->uri->getPath();
        $host = $request->uri->getHost();
        $session = \Config\Services::session();
    $session->set("useraccount_id", 1);

    $uri = str_replace("///", "/", $uri);
    $uri = str_replace("//", "/", $uri);

    $logdirectory = "../userlogs/".date('Y')."/".$host;
    if(!is_dir($logdirectory)){
    mkdir($logdirectory, 0755, true);
    }

    $logMessage = "[" . date('Y-m-d H:i:s') . "]";
    if (isset($_SESSION['useraccount_id'])) {
        $logMessage .= " | UserAccount_ID: " . $_SESSION['useraccount_id'];
    } else {
        $logMessage .= " | UserAccount_ID: NULL";
    }


    if (isset($_SESSION['user_id'])) {
        $logMessage .= " | UserID: " . $_SESSION['user_id'] . " | ";
    } else {
        $logMessage .= " | UserID: NULL | ";
    }

    $logMessage .= "Action: " . $uri . " | ";
    foreach ($_POST as $key => $value) {
        if ($value !== null) {
            if (str_contains($key, "pass")) {
                $logMessage .= htmlspecialchars($key) . ": ******** | ";
            } else {
                $logMessage .= htmlspecialchars($key) . ": " . htmlspecialchars($value) . " | ";
            }
        }
    }

    foreach ($_GET as $key => $value) {
        if ($value !== null) {
            $logMessage .= htmlspecialchars($key) . ": " . htmlspecialchars($value) . " | ";
        }
    }
    $logMessage .= "\n";
    file_put_contents($logdirectory. "/" . date('d-m') . '.log', $logMessage, FILE_APPEND);

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}