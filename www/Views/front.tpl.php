<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($seoTitle); ?></title>
    <meta name="description" content="<?php echo htmlentities($metaDescription); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include $this->view; ?>
</body>
</html>