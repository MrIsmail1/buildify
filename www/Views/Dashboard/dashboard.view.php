<div class="flex min-h-screen flex-col justify-center items-center px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Best Logo">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Dashboard</h2>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Total Pages
                    </dt>
                    <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                        <?= $totalPages ?>
                    </dd>
                    <dt class="mt-2 text-sm leading-5 font-medium text-gray-500">
                        Total Posts
                    </dt>
                    <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                        <?= $totalPosts ?>
                    </dd>
                    <dt class="mt-2 text-sm leading-5 font-medium text-gray-500">
                        Total Comments
                    </dt>
                    <dd class="mt-1 text-3xl leading-9 font-semibold text-gray-900">
                        <?= $totalComments ?>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
