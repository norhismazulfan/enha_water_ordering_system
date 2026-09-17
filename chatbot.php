<?php
include 'includes/db_connect.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

$response = "I'm not sure how to respond to that.";

if ($userMessage) {
    $sql = "SELECT response FROM chatbot_responses WHERE '$userMessage' LIKE CONCAT('%', keyword, '%') LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = $row['response'];
    }
}

echo json_encode(['response' => $response]);
?>
