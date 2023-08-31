<nav id="<?= $config['config']['id'] ?>" class="bg-blue-700">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <!-- Titre du site en H1 -->
            <h1 class="text-white text-2xl font-bold">Buildify</h1>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    <!-- Ajoutez votre logo ici -->
                </div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <ul>
                            <?php foreach ($config['menu']['items'] as $item) : ?>
                                <li class="<?= $item['class'] ?>">
                                    <a href="<?= $item['link'] ?>" id="<?= $item['id'] ?>" class="list-none text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= $item['text'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Bouton "Dashboard" à droite -->
            <div class="hidden sm:block sm:ml-6">
                <a href="/bdfy-admin/login" class="list-none text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
            </div>
        </div>
    </div>
</nav>