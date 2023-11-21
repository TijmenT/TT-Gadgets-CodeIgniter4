<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'terpstratuinen@ttsoftware.services';
public string $fromName   = 'Terpstra Tuinen';

/**
 * The "user agent"
 */
public string $userAgent = 'CodeIgniter';

/**
 * The mail sending protocol: mail, sendmail, smtp
 */
public string $protocol = 'sendmail';

/**
 * The server path to Sendmail.
 * Note: Since you're using SMTP, this setting is not used and can be left as is.
 */
public string $mailPath = '/usr/sbin/sendmail';

/**
 * SMTP Server Address
 */
public string $SMTPHost = 'ttsoftware.services';

/**
 * SMTP Username
 */
public string $SMTPUser = 'terpstratuinen@ttsoftware.services';

/**
 * SMTP Password
 */
public string $SMTPPass = 'l+[mp#_n{E=x'; // Use the actual email account's password

/**
 * SMTP Port
 */
public int $SMTPPort = 465; // Use the SMTP Port for SSL/TLS encryption

/**
 * SMTP Timeout (in seconds)
 */
public int $SMTPTimeout = 5;

/**
 * Enable persistent SMTP connections
 */
public bool $SMTPKeepAlive = false;

/**
 * SMTP Encryption (SSL/TLS).
 */
public string $SMTPCrypto = 'ssl'; // Use 'ssl' for SSL/TLS encryption

/**
 * Enable word-wrap
 */
public bool $wordWrap = true;

/**
 * Character count to wrap at
 */
public int $wrapChars = 76;

/**
 * Type of mail, either 'text' or 'html'
 */
public string $mailType = 'text';

/**
 * Character set (utf-8, iso-8859-1, etc.)
 */
public string $charset = 'UTF-8';

/**
 * Whether to validate the email address
 */
public bool $validate = false;

/**
 * Email Priority. 1 = highest. 5 = lowest. 3 = normal
 */
public int $priority = 3;

/**
 * Newline character. (Use “\r\n” to comply with RFC 822)
 */
public string $CRLF = "\r\n";

/**
 * Newline character. (Use “\r\n” to comply with RFC 822)
 */
public string $newline = "\r\n";

/**
 * Enable BCC Batch Mode.
 */
public bool $BCCBatchMode = false;

/**
 * Number of emails in each BCC batch
 */
public int $BCCBatchSize = 200;

/**
 * Enable notify message from server
 */
public bool $DSN = false;

}
