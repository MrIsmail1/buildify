<!DOCTYPE html>
<html>

<head>
    <?= $html ?? null ?>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script src="../public/js/main.js" defer></script>
</head>

<body>
    <?php include $this->view; ?>
</body>

</html>