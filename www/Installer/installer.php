<?php
$basePath = "/bdfy-admin/installer";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installer</title>
    <script src="/Installer/index.js" type="module" defer></script>
</head>

<body>
    <div id="root" data-baseurl="<?= htmlspecialchars($basePath) ?>"></div>
</body>

</html>