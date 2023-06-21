<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- Your Stylesheet -->
    <link rel="stylesheet" href="/public/css/main.css">
    <script src="/public/js/script.js" defer></script>
</head>

<body class="flex flex-col h-full">
    <!-- Header -->
    <header class="bg-gray-800 py-1 px-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-white">Dashboard</h1>
        <div class="flex items-center space-x-4">
            <a href="/help" class="text-white">
                <i class="fas fa-question-circle"></i>
            </a>
            <a href="/notifications" class="text-white">
                <i class="fas fa-bell"></i>
            </a>
            <a href="/profile" class="text-white flex items-center">
                <i class="fas fa-user-circle mr-2"></i>
                Profil
            </a>
        </div>
    </header>
