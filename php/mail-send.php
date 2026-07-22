<?php

require_once __DIR__ . '/lib/PHPMailer/Exception.php';
require_once __DIR__ . '/lib/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/lib/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

function sendInquiryEmail(array $entry): bool
{
    $configFile = __DIR__ . '/mail-config.php';
    if (!file_exists($configFile)) {
        return false;
    }

    $config = require $configFile;
    if (empty($config['password'])) {
        return false;
    }

    $labels = [
        'form_type'    => 'Form',
        'name'         => 'Name',
        'submitted_at' => 'Submitted at',
        'contact_pref' => 'Preferred contact method',
        'contact'      => 'Contact details',
        'plot_number'  => 'Plot number',
        'meter_number' => 'Meter number',
        'query'        => 'Query',
        'email'        => 'Email',
        'phone'        => 'Phone',
        'organisation' => 'Organisation',
        'inquiry_type' => 'Inquiry type',
        'message'      => 'Message',
        'request_type' => 'Request type',
        'project_name' => 'Project / event name',
    ];

    $formTypeNames = [
        'forme'       => 'For Me',
        'business'    => 'Business / Private',
        'sponsorship' => 'Sponsorship & Marketing',
    ];

    $bodyLines = [];
    foreach ($entry as $key => $value) {
        if ($value === '' || $value === null) {
            continue;
        }
        $label = $labels[$key] ?? $key;
        if ($key === 'form_type') {
            $value = $formTypeNames[$value] ?? $value;
        }
        $bodyLines[] = "{$label}: {$value}";
    }
    $body = implode("\n", $bodyLines);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = $config['host'];
        $mail->Port       = $config['port'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['username'];
        $mail->Password   = $config['password'];
        $mail->SMTPSecure = $config['encryption'] === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;

        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($config['to_email']);
        if (!empty($entry['contact']) && filter_var($entry['contact'], FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($entry['contact'], $entry['name'] ?? '');
        } elseif (!empty($entry['email']) && filter_var($entry['email'], FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($entry['email'], $entry['name'] ?? '');
        }

        $formLabel = $formTypeNames[$entry['form_type'] ?? ''] ?? 'Website';
        $mail->Subject = "New {$formLabel} inquiry from " . ($entry['name'] ?? 'website visitor');
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (PHPMailerException $e) {
        $logFile = __DIR__ . '/../storage/mail-errors.log';
        $line = '[' . date('c') . '] ' . $mail->ErrorInfo . "\n";
        file_put_contents($logFile, $line, FILE_APPEND);
        return false;
    }
}
