<header>
    <?php $this->component("menu", $menu); ?>
</header>
<main>
    <?php $this->component("main", $main); ?>
</main>

<footer class="fixed bottom-0 left-0 w-half bg-gray-200 py-4 px-6">
    <div class="container mx-auto max-h-48 overflow-y-auto">
        <h2 class="text-lg font-bold mb-2">Laissez un commentaire</h2>
        <div class="form flex mb-4">
            <div class="mr-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                <input type="text" id="first_name" name="first_name" placeholder="Votre prénom" class="input-class" required>
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" id="last_name" name="last_name" placeholder="Votre nom" class="input-class" required>
            </div>
        </div>
        <?php if (isset($commentForm)) : ?>
            <form action="<?= $commentForm['config']['action'] ?>" method="<?= $commentForm['config']['method'] ?>" class="<?= $commentForm['config']['class'] ?>" autocomplete="<?= $commentForm['config']['autocomplete'] ?>" enctype="<?= $commentForm['config']['enctype'] ?>">
                <?php foreach ($commentForm['inputs'] as $name => $config): ?>
                    <?php if ($name !== 'author'): ?>
                        <div class="mb-3">
                            <label for="<?= $name ?>" class="block text-sm font-medium text-gray-700"><?= $commentForm['labels'][$name]['text'] ?></label>
                            <?php if ($name === 'content'): ?>
                                <textarea id="<?= $name ?>" name="<?= $name ?>" placeholder="<?= $config['placeholder'] ?>" class="input-class h-32"><?= $config['value'] ?></textarea>
                            <?php else: ?>
                                <input type="<?= $config['type'] ?>" id="<?= $name ?>" name="<?= $name ?>" placeholder="<?= $config['placeholder'] ?>" class="<?= $config['class'] ?>" value="<?= $config['value'] ?>"/>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"><?= $commentForm['config']['submit'] ?></button>
                </div>
            </form>
        <?php endif; ?>
        <div class="mt-8">
            <h2 class="text-lg font-bold mb-2">Commentaires</h2>
            <?php if (is_array($comments)): ?>
                <?php foreach (array_reverse($comments) as $comment): ?>
                    <div class="bg-white p-4 rounded-md shadow-sm mb-4">
                        <p class="text-gray-600 text-sm"><?= htmlspecialchars($comment['content']); ?></p>
                        <?php if (isset($config["actions"]["report"])) : ?>
                            <a href="<?= htmlspecialchars($config["actions"]["report"] . $comment['id']) ?>" class="text-red-600 mt-2 inline-block">
                                Signaler
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</footer>














