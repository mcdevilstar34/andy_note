<?php
include 'db.php';

// Fitur POST (Simpan Catatan)
if (isset($_POST['post'])) {
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $fileName = $_FILES['media']['name'];
    $fileType = 'none';

    if ($fileName) {
        $targetDir = "uploads/";
        $targetFile = time() . "_" . basename($fileName); // Nama unik agar tidak tertukar
        move_uploaded_file($_FILES['media']['tmp_name'], $targetDir . $targetFile);
        
        // Cek apakah itu gambar atau video
        $extension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'png', 'jpeg', 'gif'])) $fileType = 'image';
        if (in_array($extension, ['mp4', 'mov', 'avi'])) $fileType = 'video';
    }

    $sql = "INSERT INTO notes (content, file_path, file_type) VALUES ('$content', '$targetFile', '$fileType')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}

// Fitur HAPUS
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM notes WHERE id=$id");
    header("Location: index.php");
}
?>