<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST['content'];
    $thread_id = $_POST['thread_id'];

    $sql = "INSERT INTO replies (thread_id, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $thread_id, $content);

    if ($stmt->execute()) {
        header("Location: view_thread.php?id=$thread_id");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
