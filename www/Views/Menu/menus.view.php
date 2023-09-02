<div class="bg-white">
    <div class="max-w-screen-xl">

        <div class="mb-10 md:mb-16">
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <div class="flex justify-between items-center px-4 py-2 bg-blue-700">
                    <a href="/bdfy-admin/menus/add" class="text-white rounded-md hover:bg-blue-500 transition duration-300">Créer Menu</a>
                </div>
                <?php if (empty($menus)) : ?>
                    <p class="p-4 text-center text-gray-500">Pas de résultat</p>
                <?php else : ?>
                    <ul class="divide-y divide-gray-200">
                        <?php foreach ($menus as $menu) : ?>
                            <li>
                                <div class="px-4 py-4 flex justify-between items-center">
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