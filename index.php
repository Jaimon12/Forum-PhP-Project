<?php
include 'db.php';

// Fetch all threads from the database
$sql = "SELECT * FROM threads ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; }
        .container { width: 80%; margin: auto; }
        .thread { padding: 15px; background: #fff; margin-bottom: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .thread h2 { margin-top: 0; }
        .new-thread { margin-bottom: 20px; text-align: center; }
        .new-thread a { padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="new-thread">
            <a href="create_thread.php">Create New Thread</a>
        </div>
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="thread">
            <h2><a href="view_thread.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a></h2>
            <p><?php echo htmlspecialchars($row['content']); ?></p>
            <small>Posted on: <?php echo $row['created_at']; ?></small>
        </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
