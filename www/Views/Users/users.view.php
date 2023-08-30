<div class="flex flex-col gap-y-10">
    <div class="">
        <button class=""><a href="/bdfy-admin/users/add" class="inline-block px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-500 transition duration-300" >Ajouter un nouvel utilisateur </a></button>
    </div>
    <div>
        <?php $this->component("dataTable", $dataTable); ?>
    </div>
</div>