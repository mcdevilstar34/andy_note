<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>andy.note</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>andy.note</h1>
        
        <form action="process.php" method="POST" enctype="multipart/form-data" class="note-form">
            <textarea name="content" placeholder="Tulis sesuatu..." required></textarea>
            <input type="file" name="media" accept="image/*,video/*">
            <button type="submit" name="post">Posting Catatan</button>
        </form>

        <hr>

        <div class="feed">
            <?php
            $query = mysqli_query($conn, "SELECT * FROM notes ORDER BY created_at DESC");
            while($row = mysqli_fetch_assoc($query)):
            ?>
            <div class="card">
                <p id="text-<?php echo $row['id']; ?>"><?php echo nl2br($row['content']); ?></p>
                
                <?php if($row['file_type'] == 'image'): ?>
                    <img src="uploads/<?php echo $row['file_path']; ?>" class="media">
                <?php elseif($row['file_type'] == 'video'): ?>
                    <video controls class="media"><source src="uploads/<?php echo $row['file_path']; ?>"></video>
                <?php endif; ?>

                <div class="actions">
                    <button onclick="copyNote(<?php echo $row['id']; ?>)">Salin</button>
                    <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn-delete">Hapus</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>