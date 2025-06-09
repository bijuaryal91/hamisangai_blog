<?php
require_once("../includes/conn.php");
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
try {
    $stmt = $conn->prepare("INSERT INTO newsletter_subscribers(email) VALUES (:email) ");
    $stmt->execute([
        ':email' => $email
    ]);

    echo "success";
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo "Email already exists.";
    } else {
        echo "Insert error: " . $e->getMessage();
    }
}
