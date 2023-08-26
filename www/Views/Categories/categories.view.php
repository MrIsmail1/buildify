<div class="flex flex-col gap-y-10">
    <div class="">
        <button class="border bg-gray-800 text-white p-3 rounded-md hover:bg-gray-600"><a href="/bdfy-admin/categories/add">Ajouter une nouvelle catégorie</a></button>
    </div>
    <div>
        <?php $this->component("dataTable", $dataTable); ?>
    </div>
</div>