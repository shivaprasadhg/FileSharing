

<?php
session_start();

// ===== Password Protection =====
$correct_password = "admin123";
if (isset($_POST['password'])) {
    if ($_POST['password'] === $correct_password) {
        $_SESSION['authenticated'] = true;
    } else {
        $error = "Incorrect password!";
    }
}
if (!isset($_SESSION['authenticated'])):
?>
<!DOCTYPE html>
<html>
<head>
    <title>Access Restricted</title>
    <style>
        body {
            background: #000;
            color: #00ff88;
            font-family: 'Courier New', monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: #111;
            padding: 40px;
            border: 1px solid #00ff88;
            box-shadow: 0 0 15px #00ff88;
            text-align: center;
        }
        input[type="password"], input[type="submit"] {
            background: #000;
            color: #00ff88;
            border: 1px solid #00ff88;
            padding: 10px 20px;
            margin-top: 10px;
            width: 100%;
        }
        h2 {
            margin-bottom: 20px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <form method="post">
        <h2>🔐 Enter Password</h2>
        <input type="password" name="password" required>
        <input type="submit" value="Enter">
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </form>
</body>
</html>
<?php
exit;
endif;

// ===== File Upload Handler =====
$upload_dir = __DIR__ . "/files/";
if (isset($_FILES['file'])) {
    $target = $upload_dir . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
        $upload_message = "✅ File uploaded successfully!";
    } else {
        $upload_message = "❌ File upload failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>HackerShare | Local File Vault</title>
    <style>
        body {
            background: #000000;
            color: #00ff88;
            font-family: 'Courier New', monospace;
            padding: 40px;
            margin: 0;
            animation: pulseBackground 10s infinite alternate;
        }

        @keyframes pulseBackground {
            0% { background-color: #000; }
            100% { background-color: #050505; }
        }

        h1 {
            font-size: 3em;
            text-align: center;
            margin-bottom: 10px;
            letter-spacing: 2px;
            animation: glitch 2s infinite;
        }

        @keyframes glitch {
            0% { text-shadow: 2px 0 red, -2px 0 blue; }
            50% { text-shadow: -1px 0 red, 1px 0 blue; }
            100% { text-shadow: 2px 0 red, -2px 0 blue; }
        }

        p {
            text-align: center;
            color: #55ffbb;
        }

        form {
            text-align: center;
            margin: 30px auto;
            max-width: 400px;
        }

        input[type="file"], input[type="submit"] {
            background: #000;
            color: #00ff88;
            border: 1px solid #00ff88;
            padding: 10px;
            margin-top: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .file-list {
            max-width: 600px;
            margin: 40px auto;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        li {
            margin-bottom: 10px;
            border-bottom: 1px dashed #00ff88;
            padding-bottom: 5px;
        }

        a {
            color: #00ff88;
            text-decoration: none;
        }

        a:hover {
            color: #ff0055;
            text-decoration: underline;
        }

        hr {
            border-color: #00ff88;
            margin-top: 40px;
        }

        .footer {
            text-align: center;
            color: #008855;
            margin-top: 60px;
            font-size: 0.9em;
        }

        .message {
            text-align: center;
            color: #00ffaa;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h1>📁 HackerShare</h1>
    <p>Upload and download files on your local network</p>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <input type="submit" value="Upload File">
    </form>

    <?php if (isset($upload_message)): ?>
        <p class="message"><?= htmlspecialchars($upload_message) ?></p>
    <?php endif; ?>

    <div class="file-list">
        <h2>📂 Files:</h2>
        <ul>
        <?php
            $files = scandir($upload_dir);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    echo "<li><a href='files/" . urlencode($file) . "' download>" . htmlspecialchars($file) . "</a></li>";
                }
            }
        ?>
        </ul>
    </div>

    <hr>
    <div class="footer">
        HackerShare | Local Network File Vault 🐧
    </div>

</body>
</html>
