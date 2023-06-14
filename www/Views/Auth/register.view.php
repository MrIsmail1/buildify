<h2>Register</h2>

<div class="flex min-h-screen flex-col justify-center items-center px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Best Logo">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Welcome to buildify</h2>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <?php $this->modal("form", $form); ?>
        <div class="mt-3 inline-flex space-x-1">
            <?php if (isset($errors)) : ?>
                <span class="text-md text-red-600">*</span>
                <span class="text-md text-red-600">
                    <?php print_r($errors[0] ?? null); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>