<div id="<?= htmlspecialchars($config["config"]["id"]) ?>" class="<?= htmlspecialchars($config["config"]["class"]) ?>">

    <h1 id="<?= htmlspecialchars($config["title"]["id"]) ?>" class="<?= htmlspecialchars($config["title"]["class"]) ?>">
        <?= htmlspecialchars($config["title"]["text"]) ?>
    </h1>
    <div id="<?= htmlspecialchars($config["content"]["id"]) ?>" class="<?= htmlspecialchars($config["content"]["class"]) ?>">
        <?= ($config["content"]["text"]) ?>
    </div>
    <?php if (isset($config['articles']) && count(($config['articles']))) : ?>
        <h2 class="text-2xl font-semibold mt-6 mb-4">Articles récents</h2>
        <div>
            <form id="category-filter-form" class="flex space-x-2">
                <label for="category-select" class="text-gray-700">Filtrer par catégorie :</label>
                <select id="category-select" name="category" class="border rounded-md px-2 py-1">
                    <option value="">Toutes les catégories</option>
                    <?php foreach ($config['categorie'] as $category) : ?>
                        <option value="<?= htmlspecialchars($category['id']) ?>"><?= htmlspecialchars($category['title']) ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <div id="filtered-articles" class="data-container" data-articles="<?= htmlspecialchars(json_encode($config['articles'])) ?>">
            <?php foreach ($config['articles'] as $article) : ?>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($article['articletitle']) ?></h3>
                        <p class="text-gray-600 text-sm mb-2">Auteur : <?= htmlspecialchars($article['articleauthor']) ?></p>
                        <p class="text-gray-600 text-sm mb-2">Date de publication : <?php $date = new \DateTime(htmlspecialchars($article['last_modified'])) ?> <?= htmlspecialchars($date->format('Y-m-d')) ?></p>
                        <p class="text-gray-700 text-sm"><?= ($article['content']) ?></p>
                        <a href="article/singlearticle?id=<?= htmlspecialchars($article['id']) ?>" class="text-blue-500 hover:underline">Voir l'article</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>