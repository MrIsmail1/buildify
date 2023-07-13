<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ma super page</title>
    <meta name="description" content="Ceci est ma super page">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="../public/DataTables/datatables.min.css">
    <script src="../public/DataTables/datatables.min.js" defer></script>
    <script src="../public/js/jquery-3.6.0.js"></script>
    <script src="../public/js/script.js" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>


</head>

<body>

    <?php
    require __DIR__ . '/Layout/header.php';    ?>

    <div class="flex h-screen">
        <?php require __DIR__ . '/Layout/sidebar.php' ?>
        <div class="flex-grow p-5 overflow-y-auto">
            <?php include $this->view; ?></div>

    </div>
    <?php require __DIR__ . '/Layout/footer.php';    ?>

</body>


</html>