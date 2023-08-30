<head>
    <link rel="stylesheet" href="">
</head>
<div class="flex flex-col gap-y-10">
    <div class="">
        <!-- Bouton pour ajouter une nouvelle page -->
        <button class=""><a href="/bdfy-admin/pages/add" class="inline-block px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-500 transition duration-300">Ajouter une page</a></button>
    </div>
    <div>
        <?php $this->component("dataTable", $dataTable); ?>
        <!-- Inclusion du composant "dataTable" avec la variable $dataTable passée en tant que paramètre -->
    </div>
</div>