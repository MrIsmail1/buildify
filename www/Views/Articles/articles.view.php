
<head>
    <link rel="stylesheet" href="">
</head>
<div class="flex flex-col gap-y-10">
    <div class="">
        <!-- Bouton pour ajouter une nouvelle page -->
        <button class="border bg-gray-800 text-white p-3 rounded-md hover:bg-gray-100"><a href="/bdfy-admin/articles/add">Ajouter un article</a></button>
    </div>
    <div>
        <?php $this->component("dataTable", $dataTable); ?>
        <!-- Inclusion du composant "dataTable" avec la variable $dataTable passée en tant que paramètre -->
    </div>
</div>