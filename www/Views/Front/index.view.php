<header>
    <?php $this->component("menu", $menu); ?>
</header>
<main>
    <?php $this->component("main", $main); ?>
</main>

<footer class="fixed bottom-0 left-0 w-half bg-gray-200 py-2 px-3">
    <div class="container mx-auto max-h-48 overflow-y-auto">
        <h2 class="text-lg font-bold mb-1">Commentaires</h2>
            <div>
                <?php if(is_array($comments)): ?>
                    <?php foreach (array_reverse($comments) as $comment): ?>
                        <div class="flex bg-white p-2 rounded-md shadow-sm mb-2">
                            <p class="text-gray-800 text-sm font-semibold"><?php echo htmlspecialchars($comment['comment_author']); ?></p>
                            <p class="text-gray-600 text-sm ml-2"><?php echo htmlspecialchars($comment['content']); ?></p>
                            <?php if (isset($config["actions"]["report"])) : ?>
                                <a href="<?= htmlspecialchars($config["actions"]["report"] . $comment['id']) ?>" class="ml-auto">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </a>
                            <?php endif;?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
    </div>
    <div class="form">
    <?php if (isset($commentForm)) : ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>">
        <form action="<?= $commentForm['config']['action'] ?>" method="<?= $commentForm['config']['method'] ?>" class="<?= $commentForm['config']['class'] ?>" autocomplete="<?= $commentForm['config']['autocomplete'] ?>" enctype="<?= $commentForm['config']['enctype'] ?>">
            <?php foreach ($commentForm['inputs'] as $name => $config): ?>
                <label for="<?= $name ?>"><?= $commentForm['labels'][$name]['text'] ?></label>
                <input type="<?= $config['type'] ?>" id="<?= $name ?>" name="<?= $name ?>" placeholder="<?= $config['placeholder'] ?>" class="<?= $config['class'] ?>" value="<?= $config['value'] ?>"/>
            <?php endforeach; ?>
            <input type="submit" value="<?= $commentForm['config']['submit'] ?>">
        </form>
        </form>
    <?php endif; ?>
</div>
</footer>










