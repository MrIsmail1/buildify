<!DOCTYPE html>
<html>
    <?php 
    if (!empty($_POST['nom'])) {
        setcookie('user', $_POST['nom']);
    };
    ?>

<head>
    <title>Tableau de bord</title>
     
</head>
<body>
    <h1>Tableau de bord</h1>
    <!-- Ici, vous pouvez ajouter du HTML pour afficher les données de votre tableau de bord. -->
</body>
</html>