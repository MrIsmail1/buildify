<div id="<?= $config["config"]["id"] ?>" class="<?= $config["config"]["class"] ?>">

    <h1 id="<?= $config["title"]["id"] ?>" class="<?= $config["title"]["class"] ?>">
        <?= $config["title"]["text"] ?>
    </h1>
    <div id="<?= $config["content"]["id"] ?>" class="<?= $config["content"]["class"] ?>">
        <?= $config["content"]["text"] ?>
    </div>
    <?php if (count($config['articles'])) : ?>
        <h2 class="text-2xl font-semibold mt-6 mb-4">Articles récents</h2>

        <div>
            <form id="category-filter-form" class="flex space-x-2">
                <label for="category-select" class="text-gray-700">Filtrer par catégorie :</label>
                <select id="category-select" name="category" class="border rounded-md px-2 py-1">
                    <option value="">Toutes les catégories</option>
                    <?php foreach ($config['categorie'] as $category) : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3" id="filtered-articles">
            <?php foreach ($config['articles'] as $article) : ?>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2"><?= $article['articletitle'] ?></h3>
                        <p class="text-gray-600 text-sm mb-2">Auteur : <?= $article['articleauthor'] ?></p>
                        <p class="text-gray-600 text-sm mb-2">Date de modification : <?= $article['last_modified'] ?></p>
                        <p class="text-gray-700 text-sm"><?= $article['content'] ?></p>
                        <a href="article/singlearticle?id=<?= $article['id'] ?>" class="text-blue-500 hover:underline">Voir l'article</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const categorySelect = document.getElementById("category-select");
        const filteredArticles = document.getElementById("filtered-articles");
        const articleData = <?= json_encode($config['articles']) ?>;

        categorySelect.addEventListener("change", function() {
            const selectedCategoryId = categorySelect.value;
            let filteredArticleHtml = "";

            for (const article of articleData) {
                if (!selectedCategoryId || article.categorie_id == selectedCategoryId) {
                    filteredArticleHtml += `
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">${article.articletitle}</h3>
                                <p class="text-gray-600 text-sm mb-2">Auteur : ${article.articleauthor}</p>
                                <p class="text-gray-600 text-sm mb-2">Date de modification : ${article.last_modified}</p>
                                <p class="text-gray-700 text-sm">${article.content}</p>
                                <a href="article/singlearticle?id=${article.id}">Voir l'article</a>
                            </div>
                        </div>
                    `;
                }
            }

            filteredArticles.innerHTML = filteredArticleHtml;
        });

        categorySelect.dispatchEvent(new Event("change"));
    });
</script>
<?php endif; ?>