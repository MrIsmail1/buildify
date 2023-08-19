<div id="singlearticle" class="text-xl p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-semibold mb-4"><?= $article[0]['articletitle'] ?></h1>
    <div class="text-lg mb-4"><?= $article[0]['content'] ?></div>
    <div class="text-sm text-gray-600">
        Auteur : <?= $article[0]['articleauthor'] ?> | Date de modification : <?= $article[0]['last_modified'] ?>
    </div>
    <a href="<?= isset($_SESSION['previous_url']) ? $_SESSION['previous_url'] : '/articles' ?>" class="text-blue-500 hover:underline mt-4 block">Retour à la liste des articles</a>

</div>
