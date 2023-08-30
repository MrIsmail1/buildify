<div class="flex flex-grow">
    <!-- Content -->
    <div class="flex-grow p-4">
        <div class="bg-white rounded-lg p-6 shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Statistiques</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="border rounded-md p-4 shadow-sm">
                    <h3 class="text-lg text-gray-600 mb-4">Total des Pages</h3>
                    <p class="text-4xl font-bold text-gray-900"><?= intval($totalPages) ?></p>
                </div>
                <div class="border rounded-md p-4 shadow-sm">
                    <h3 class="text-lg text-gray-600 mb-4">Total des Commentaires</h3>
                    <p class="text-4xl font-bold text-gray-900"><?= intval($totalComments) ?></p>
                </div>
            </div>
            <div class="mt-8">
                <div class="border rounded-md p-4 shadow-sm">
                    <h3 class="text-lg text-gray-600 mb-4">Dernières Pages</h3>
                    <?php foreach ($lastPages as $page): ?>
                        <div class="border-b border-gray-200 mb-4 pb-4">
                            <p class="text-sm text-gray-700"><span class="font-bold">Titre : </span><?= $page['pagetitle'] ?></p>
                            <p class="text-sm text-gray-700"><span class="font-bold">Contenu : </span><?= $page['content'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="mt-8">
                <div class="border rounded-md p-4 shadow-sm">
                    <h3 class="text-lg text-gray-600 mb-4">Derniers Commentaires</h3>
                    <?php foreach ($lastComments as $comment): ?>
                        <div class="border-b border-gray-200 mb-4 pb-4">
                            <p class="text-sm text-gray-700"><span class="font-bold">Auteur : </span><?= $comment['comment_author'] ?></p>
                            <p class="text-sm text-gray-700"><span class="font-bold">Commentaire : </span><?= $comment['content'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
