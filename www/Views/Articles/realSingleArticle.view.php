<div id="singlearticle" class="text-xl p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-semibold mb-4"><?= $article[0]['articletitle'] ?></h1>
    <div class="text-lg mb-4"><?= $article[0]['content'] ?></div>
    <div class="text-sm text-gray-600">
        Auteur : <?= $article[0]['articleauthor'] ?> | Date de modification : <?= $article[0]['last_modified'] ?>
    </div>
    <a href="<?= isset($_SESSION['previous_url']) ? $_SESSION['previous_url'] : '/articles' ?>" class="text-blue-500 hover:underline mt-4 block">Retour à la liste des articles</a>

</div>

<div id="comments" class="text-xl p-6 bg-white shadow-md rounded-lg mt-6">
    <h2 class="text-lg font-bold mb-4">Commentaires</h2>
    <div>
        <?php if (is_array($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="flex bg-white p-2 rounded-md shadow-sm mb-2">
                    <p class="text-gray-800 text-sm font-semibold"><?= htmlspecialchars($comment['comment_author']) ?></p>
                    <p class="text-gray-600 text-sm ml-2"><?= htmlspecialchars($comment['content']) ?></p>
                    <?php if (isset($config["actions"]["report"])) : ?>
                        <a href="<?= htmlspecialchars($config["actions"]["report"] . $comment['id']) ?>" class="ml-auto">
                            <i class="fas fa-exclamation-triangle"></i>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="form mt-4">
    <?php if (isset($commentForm)) : ?>
        <form action="<?= htmlspecialchars($commentForm['config']['action']) ?>"
              method="<?= htmlspecialchars($commentForm['config']['method']) ?>"
              class="<?= htmlspecialchars($commentForm['config']['class']) ?>"
              autocomplete="<?= htmlspecialchars($commentForm['config']['autocomplete']) ?>"
              enctype="<?= htmlspecialchars($commentForm['config']['enctype']) ?>">
            <?php foreach ($commentForm['inputs'] as $name => $config): ?>
                <div class="mb-3">
                    <label for="<?= htmlspecialchars($name) ?>"
                           class="block text-sm font-medium text-gray-700"><?= htmlspecialchars($commentForm['labels'][$name]['text']) ?></label>
                    <?php if ($config['type'] === 'textarea') : ?>
                        <textarea id="<?= htmlspecialchars($name) ?>"
                                  name="<?= htmlspecialchars($name) ?>"
                                  placeholder="<?= htmlspecialchars($config['placeholder']) ?>"
                                  class="<?= htmlspecialchars($config['class']) ?>"
                                  rows="<?= $config['rows'] ?>"
                                  cols="<?= $config['cols'] ?>"></textarea>
                    <?php else: ?>
                        <input type="<?= htmlspecialchars($config['type']) ?>"
                               id="<?= htmlspecialchars($name) ?>"
                               name="<?= htmlspecialchars($name) ?>"
                               placeholder="<?= htmlspecialchars($config['placeholder']) ?>"
                               class="<?= htmlspecialchars($config['class']) ?>"
                               value="<?= htmlspecialchars($config['value']) ?>"/>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    <?= htmlspecialchars($commentForm['config']['submit']) ?>
                </button>
            </div>
        </form>
    <?php endif; ?>
</div>