<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['long_url'])) {
    $short_code = substr(md5(uniqid()), 0, 6);
    $long_url = $_POST['long_url'];
    $sql = "INSERT INTO urls (long_url, short_code) VALUES ('$long_url', '$short_code')";
    if ($conn->query($sql) === TRUE) {
        $shortened_url = "http://localhost/urlsh/$short_code"; // Change example.com to your domain
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md" style="max-width: 640px; width: 100%;">
        <h1 class="text-4xl font-bold text-center mb-4">URL Shortener</h1>
        <p class="text-gray-600 text-center mb-8">This PHP script shortens URLs and displays the shortened link. It utilizes a MySQL database for storage.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mb-4">
            <div class="flex flex-wrap">
                <input type="url" name="long_url" class="flex-1 p-2 border rounded-l outline-none" placeholder="Paste the long URL" required>
                <button type="submit" class="bg-pink-300 px-4 py-2 border rounded-r">Shorten URL</button>
            </div>
        </form>

        <?php if (isset($shortened_url)): ?>
            <div class="rounded p-4 bg-pink-100 flex justify-between items-center">
                <span><?php echo $shortened_url; ?></span>
                <div>
                    <button onclick="copyToClipboard()" class="bg-pink-300 px-4 py-2 rounded">Copy</button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function copyToClipboard() {
        var copyText = document.createElement('textarea');
        copyText.value = "<?php echo $shortened_url; ?>";
        document.body.appendChild(copyText);
        copyText.select();
        document.execCommand("copy");
        document.body.removeChild(copyText);
    }
</script>
</body>
</html>
