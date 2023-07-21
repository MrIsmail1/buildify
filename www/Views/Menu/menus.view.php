<div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="max-w-screen-xl px-4 md:px-6 mx-auto">

        <div class="mb-10 md:mb-16">
            <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">List of Menus</h2>

            <div class="max-w-sm md:max-w-3xl mx-auto overflow-hidden bg-white rounded-lg shadow-md">
                <button class="border bg-gray-800 text-white p-3 rounded-md hover:bg-gray-100"><a href="/bdfy-admin/menus/add">Créer Menu</a></button>
                <?php if (empty($menus)) : ?>
                    <p class="p-4 text-center text-gray-500">Pas de résultat</p>
                <?php else : ?>
                    <ul class="divide-y divide-gray-200">
                        <?php foreach ($menus as $menu) : ?>
                            <li>
                                <div class="px-4 py-4 flex justify-between">
                                    <div class="flex-1 pr-4">
                                        <p class="text-sm font-semibold text-gray-500"><?= $menu["name"] ?></p>
                                        <p class="text-sm text-gray-500"><?= $menu["active"] ? 'Active' : 'Inactive' ?></p>
                                        <p class="mt-2 text-sm text-gray-700"><?= $menu["items"] ?></p>
                                    </div>

                                    <div class="flex items-center space-x-4">
                                        <a href="/bdfy-admin/menu/edit?id=<?= $menu["id"] ?>" class="inline-flex items-center justify-center h-10 px-4 font-semibold text-white transition duration-200 bg-blue-600 rounded hover:bg-blue-500 focus:outline-none">
                                            Edit
                                        </a>
                                        <a href="/bdfy-admin/menu/delete?id=<?= $menu["id"] ?>" class="inline-flex items-center justify-center h-10 px-4 font-semibold text-white transition duration-200 bg-red-600 rounded hover:bg-red-500 focus:outline-none">
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>