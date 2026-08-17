<?php
/**
 * Router for PHP's built-in web server (php -S), used on Render.
 *
 * The built-in server ignores .htaccess entirely, so without this router
 * every file under /storage (customer inquiries, job applications, CVs)
 * and /php (page content, mail-config.php, vendored PHPMailer) is served
 * as a plain static file to anyone who requests its URL directly. This
 * mirrors the access rules in storage/.htaccess and php/.htaccess, which
 * apache/cPanel hosting enforces on its own.
 */

$path = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if (preg_match('#^/(storage|php)(/|$)#', $path)) {
    http_response_code(403);
    header('Content-Type: text/plain');
    echo 'Forbidden';
    return true;
}

// Anything else: let the built-in server serve the file or execute the
// .php script as it normally would.
return false;
