<?php
$basePath = "/bdfy-admin/installer";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/Installer/index.js" type="module"></script>
</head>

<body>
    <div id="root" data-baseurl="<?= htmlspecialchars($basePath) ?>"></div>
</body>

</html>