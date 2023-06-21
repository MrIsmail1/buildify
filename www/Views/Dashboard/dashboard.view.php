    <?php 
         require __DIR__ . '/../Layout/header.php';
    ?>

    <!-- Main Content -->
    <div class="flex flex-grow">
        <?php
            require __DIR__ . '/../Layout/sidebar.php'
        ?>

        <!-- Content -->
        <div class="flex-grow p-1">
            <div class="bg-white rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Statistiques</h2>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <h3 class="text-sm text-gray-500">Total des Pages</h3>
                        <p class="text-3xl font-semibold text-gray-900"><?= $totalPages ?></p>
                    </div>
                    <div>
                        <h3 class="text-sm text-gray-500">Total des Articles</h3>
                        <p class="text-3xl font-semibold text-gray-900"><?= $totalPosts ?></p>
                    </div>
                    <div>
                        <h3 class="text-sm text-gray-500">Total des Commentaires</h3>
                        <p class="text-3xl font-semibold text-gray-900"><?= $totalComments ?></p>
                    </div>
                </div>

                <!-- Latest Comments -->
                <div class="mt-6 bg-white rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Derniers Commentaires</h2>
                    <ul>
                        <?php foreach ($latestComments as $comment): ?>
                        <li>
                            <p class="font-bold"><?= htmlspecialchars($comment['username']) ?></p>
                            <p><?= htmlspecialchars($comment['content']) ?></p>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars($comment['date_created']) ?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Latest Pages -->
                <div class="mt-6 bg-white rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Dernières Pages</h2>
                    <ul>
                        <?php foreach ($latestPages as $page): ?>
                        <li>
                            <p class="font-bold"><?= htmlspecialchars($page['title']) ?></p>
                            <p><?= htmlspecialchars($page['description']) ?></p>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars($page['date_created']) ?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php
        require __DIR__ . '/../Layout/footer.php' ;
    ?>
</html>
