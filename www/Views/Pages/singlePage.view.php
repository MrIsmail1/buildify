<div class="w-9/12">
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