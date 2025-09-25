<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Files</title>
    <link rel="icon" href="recycle final logo 2.png" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1a1a1a;
            color: #f4f4f4;
            padding: 20px;
        }
        h2 {
            color: gold;
            text-align: center;
        }
        .file-box {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
        }
        .file-card {
            background: #000;
            padding: 15px;
            border: 2px solid gold;
            border-radius: 12px;
            width: 200px;
            text-align: center;
            animation: fadeIn 1.5s ease;
        }
        .file-card img {
            max-width: 100%;
            border-radius: 8px;
        }
        a {
            color: gold;
            text-decoration: none;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <h2>📑 Uploaded Files</h2>
    <div class="file-box">
        <?php
        $result = $conn->query("SELECT * FROM files ORDER BY uploaded_on DESC");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filePath = $row['file_path'];
                $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                echo "<div class='file-card'>";
                // File type icons
                $icons = [
                    "pdf"   => "https://cdn-icons-png.flaticon.com/512/337/337946.png",
                    "doc"   => "https://cdn-icons-png.flaticon.com/512/281/281760.png",
                    "docx"  => "https://cdn-icons-png.flaticon.com/512/281/281760.png",
                    "xls"   => "https://cdn-icons-png.flaticon.com/512/732/732220.png",
                    "xlsx"  => "https://cdn-icons-png.flaticon.com/512/732/732220.png",
                    "ppt"   => "https://cdn-icons-png.flaticon.com/512/732/732224.png",
                    "pptx"  => "https://cdn-icons-png.flaticon.com/512/732/732224.png",
                    "txt"   => "https://cdn-icons-png.flaticon.com/512/3022/3022506.png",
                    "zip"   => "https://cdn-icons-png.flaticon.com/512/2306/2306183.png",
                    "rar"   => "https://cdn-icons-png.flaticon.com/512/2306/2306183.png",
                    "py"    => "https://cdn-icons-png.flaticon.com/512/5968/5968350.png",
                    "js"    => "https://cdn-icons-png.flaticon.com/512/5968/5968292.png",
                    "html"  => "https://cdn-icons-png.flaticon.com/512/5968/5968267.png",
                    "css"   => "https://cdn-icons-png.flaticon.com/512/5968/5968242.png",
                    "mp4"   => "https://cdn-icons-png.flaticon.com/512/136/136524.png",
                    "mp3"   => "https://cdn-icons-png.flaticon.com/512/136/136539.png",
                    "tcl"   => "https://cdn-icons-png.flaticon.com/512/5968/5968371.png",
                    "sql"   => "https://cdn-icons-png.flaticon.com/512/2772/2772128.png"
                ];

                if (in_array($ext, ["jpg","jpeg","png","gif"])) {
                    echo "<img src='$filePath' alt='Image'>";
                } elseif (array_key_exists($ext, $icons)) {
                    echo "<img src='".$icons[$ext]."' width='80'>";
                } else {
                    echo "<img src='https://cdn-icons-png.flaticon.com/512/833/833524.png' width='80'>";
                }
                echo "<p><a href='$filePath' target='_blank'>".$row['file_name']."</a></p>";
                echo "</div>";
            }
        } else {
            echo "<p style='text-align:center;'>No files uploaded yet.</p>";
        }
        ?>
    </div>
    <p style="text-align:center;"><a href="upload.php">⬅ Back to Upload</a></p>
</body>
</html>

