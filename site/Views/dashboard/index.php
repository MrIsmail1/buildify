<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    
</head>
<body class="bg-gray-200">
    <div class="flex">
        <?php include 'sidebar.php' ; ?>
        <div class="w-9/12">
            <h2 class="text-2x1 p-5">Dashboard</h2>
            <?php include 'stats.php'; ?>
            <?php include 'recent_content.php';?>
            <?php include 'dashboard.php' ;?>
        </div>

    </div>
    
</body>
</html>