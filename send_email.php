<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["Name"]));
    $email = htmlspecialchars(trim($_POST["Email"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email address."]);
        exit;
    }

    $mailtrap_api_token = "d87340bac006fec31ec1aeb734e46a5f";
    $mailtrap_inbox_email = "ankitpanchal8717@gmail.com";

    $postData = [
        "from" => ["email" => "mailtrap@ankitpanchal.online", "name" => "Mailtrap Test"],
        "to" => [["email" => $mailtrap_inbox_email]],
        "subject" => "New Contact Form Submission",
        "text" => "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message",
        "category" => "Contact Form"
    ];

    $ch = curl_init('https://send.api.mailtrap.io/api/send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $mailtrap_api_token,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    $response = curl_exec($ch);
    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($responseCode == 200) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send email."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
