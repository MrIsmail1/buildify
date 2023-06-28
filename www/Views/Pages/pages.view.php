<div class="flex flex-col gap-y-10">
    <div class="">
        <button class="border bg-gray-800 text-white p-3 rounded-md hover:bg-gray-100"><a href="/pages/add">Ajouter une page</a></button>
    </div>
    <div>
        <?php $this->component("dataTable", $dataTable); ?>
    </div>
</div>