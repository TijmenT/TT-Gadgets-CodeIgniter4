<?php
/*

*/

function deleteOldLogs($logsDirectory, $maxDaysToKeep, $domain)
{
    $today = new DateTime();
    $today->setTime(0, 0, 0);

    $yearFolders = scandir($logsDirectory);
    foreach ($yearFolders as $yearFolder) {
        if (is_dir($logsDirectory . '/' . $yearFolder) && is_numeric($yearFolder)) {
            $domainFolder = $domain;
            
            if (is_dir($logsDirectory . '/' . $yearFolder . '/' . $domainFolder)) {
                $domainPath = $logsDirectory . '/' . $yearFolder . '/' . $domainFolder;
                $logFiles = scandir($domainPath);

                foreach ($logFiles as $logFile) {
                    if ($logFile !== "." && $logFile !== "..") {
                        $logFilePath = $domainPath . '/' . $logFile;

                        if (is_file($logFilePath)) {
                            $fileNameParts = explode('-', pathinfo($logFile, PATHINFO_FILENAME));

                            if (count($fileNameParts) === 2) {
                                $logFileDate = new DateTime("$yearFolder-{$fileNameParts[0]}-{$fileNameParts[1]}");
                                $interval = $today->diff($logFileDate);
                                $daysDifference = $interval->days;

                                if ($daysDifference > $maxDaysToKeep) {
                                    if ($logFileDate < $today) {
                                        unlink($logFilePath);
                                        echo "Deleted: $logFilePath\n";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function transferOldLogs($logsDirectory, $maxDaysToKeep, $domain)
{
    $today = new DateTime();
    $today->setTime(0, 0, 0);

    $yearFolders = scandir($logsDirectory);
    foreach ($yearFolders as $yearFolder) {
        if (is_dir($logsDirectory . '/' . $yearFolder) && is_numeric($yearFolder)) {
            $domainFolder = $domain;

            if (is_dir($logsDirectory . '/' . $yearFolder . '/' . $domainFolder)) {
                $domainPath = $logsDirectory . '/' . $yearFolder . '/' . $domainFolder;
                $logFiles = scandir($domainPath);

                foreach ($logFiles as $logFile) {
                    if ($logFile !== "." && $logFile !== "..") {
                        $logFilePath = $domainPath . '/' . $logFile;

                        if (is_file($logFilePath)) {
                            $fileNameParts = explode('-', pathinfo($logFile, PATHINFO_FILENAME));

                            if (count($fileNameParts) === 2) {
                                $logFileDate = new DateTime("$yearFolder-{$fileNameParts[0]}-{$fileNameParts[1]}");
                                $interval = $today->diff($logFileDate);
                                $daysDifference = $interval->days;

                                if ($daysDifference > $maxDaysToKeep) {
                                    if ($logFileDate < $today) {
                                        $oldLogsDirectory = $logsDirectory . '_old/' . $yearFolder . '/' . $domainFolder;
                                        
                                        if (!is_dir($oldLogsDirectory)) {
                                            mkdir($oldLogsDirectory, 0777, true);
                                        }

                                        $destinationPath = $oldLogsDirectory . '/' . $logFile;
                                        
                                        if (rename($logFilePath, $destinationPath)) {
                                            echo "transferred: $logFilePath\n";
                                        } else {
                                            echo "failed: $logFilePath\n";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    die();
}
