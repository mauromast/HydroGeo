<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Indirizzo email del destinatario
    $receiving_email_address = 'hydrogeosrl@gmail.com'; // **CAMBIA CON LA TUA VERA EMAIL**

    // Dati dal modulo
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $company = filter_var(trim($_POST['company']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
    $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    // Validazione base
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        // Puoi reindirizzare a una pagina di errore o mostrare un messaggio
        header('Location: contatti.html?status=error_validation');
        exit;
    }

    // Costruzione del messaggio email
    $email_subject = "Nuovo messaggio da HydroGeo s.r.l. - Oggetto: " . $subject;
    $email_body = "Hai ricevuto un nuovo messaggio dal form di contatto del tuo sito web.\n\n";
    $email_body .= "Nominativo: " . $name . "\n";
    if (!empty($company)) {
        $email_body .= "Azienda: " . $company . "\n";
    }
    $email_body .= "Email: " . $email . "\n";
    if (!empty($phone)) {
        $email_body .= "Telefono: " . $phone . "\n";
    }
    $email_body .= "Oggetto: " . $subject . "\n\n";
    $email_body .= "Messaggio:\n" . $message . "\n";

    // Header per l'email
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

    // Invio dell'email
    if (mail($receiving_email_address, $email_subject, $email_body, $headers)) {
        // Reindirizza a una pagina di successo
        header('Location: contatti.html?status=success');
    } else {
        // Reindirizza a una pagina di errore
        header('Location: contatti.html?status=error_send');
    }
} else {
    // Se la richiesta non è POST, reindirizza al modulo
    header('Location: contatti.html');
}
exit;
?>