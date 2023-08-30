<div class="w-9/12">
    <?php if (isset($id)) :?>
    <div class="flex justify-end">
        <button class="">
    <a href="/bdfy-admin/pages/history?id=<?= $id ?>" class="inline-block px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-500 transition duration-300">
    Historique
</a>
</button>

    </div>
    <?php endif;?>   
    <?php $this->component("form", $form); ?>

    <div class="mt-3 inline-flex space-x-1">
        <?php if (isset($errors)) : ?>
            <span class="text-md text-red-600">*</span>
            <span class="text-md text-red-600">
                <?php print_r($errors[0] ?? null); ?>
            </span>
        <?php endif; ?>
    </div>
</div>