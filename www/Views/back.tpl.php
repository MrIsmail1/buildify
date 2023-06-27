<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ma super page</title>
    <meta name="description" content="Ceci est ma super page">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body>
    
        <?php 
         require __DIR__ . '/Layout/header.php';    ?>
   
<div class="flex h-screen">
    <?php require __DIR__ . '/Layout/sidebar.php' ?>
<div class="flex-grow"> <?php include $this->view; ?></div>
   
</div>
    <?php require __DIR__ . '/Layout/footer.php' ;    ?>

</body>


</html>