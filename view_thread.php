<?php
include 'db.php';

$thread_id = $_GET['id'];

// Fetch thread data
$sql = "SELECT * FROM threads WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $thread_id);
$stmt->execute();
$thread = $stmt->get_result()->fetch_assoc();

// Fetch replies for this thread
$sql = "SELECT * FROM replies WHERE thread_id = ? ORDER BY created_at ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $thread_id);
$stmt->execute();
$replies = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Thread</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; }
        .container { width: 80%; margin: auto; }
        .thread, .reply, form { background: #fff; padding: 15px; margin-bottom: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .thread h2 { margin-top: 0; }
        input[type=text], textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        input[type=submit], .back-btn { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .back-btn { background-color: #6c757d; text-decoration: none; display: inline-block; }
        .back-btn:hover, input[type=submit]:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <div class="thread">
            <h2><?php echo htmlspecialchars($thread['title']); ?></h2>
            <p><?php echo htmlspecialchars($thread['content']); ?></p>
            <small>Posted on: <?php echo $thread['created_at']; ?></small>
        </div>

        <?php while($reply = $replies->fetch_assoc()): ?>
        <div class="reply">
            <p><?php echo htmlspecialchars($reply['content']); ?></p>
            <small>Replied on: <?php echo $reply['created_at']; ?></small>
        </div>
        <?php endwhile; ?>

        <h3>Post a Reply</h3>
        <form method="post" action="post_reply.php">
            <textarea name="content" rows="4" required></textarea>
            <input type="hidden" name="thread_id" value="<?php echo $thread_id; ?>">
            <input type="submit" value="Post Reply">
        </form>
        
        <!-- Back to Home Page Button -->
        <a href="index.php" class="back-btn">Back to Home Page</a>
    </div>
</body>
</html>
