<div class="w-9/12">
    <?php if (isset($id)) :?>
    <div class="flex justify-end">
        <button class="border bg-gray-800 text-white p-3 rounded-md hover:bg-gray-100"><a href=<?= "/bdfy-admin/pages/history?id={$id}" ?>>Historique</a></button>
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

