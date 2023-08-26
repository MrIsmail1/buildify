<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div id="comments" class="max-h-58 text-xl  bg-white  mt-6 pb-4">
    <h2 class="text-lg font-bold mb-4">Commentaires</h2>
    <div class="max-h-52 mx-auto w-full float-left overflow-y-scroll">
        <?php if (isset($config["comments"])) : ?>
            <?php foreach ($config["comments"] as $comment) : ?>
                <div class="flex bg-gray-100 p-3 rounded-lg shadow-md mb-4   ">
                    
                        <i class="fas fa-user h-8 w-8 rounded-full"></i>
                    
                    <div class="ml-3 flex-grow ">
                        <div class="text-gray-800 text-sm font-semibold"><?= htmlspecialchars($comment['comment_author']) ?></div>
                        <div class="text-gray-600 text-sm"><?= htmlspecialchars($comment['content']) ?></div>
                    </div>

                    <?php if (isset($config["actions"]["report"])) : ?>
                        <a href="<?= htmlspecialchars($config["actions"]["report"] . $comment['id']) ?>" class="ml-auto">
                            <i class="fas fa-exclamation-triangle text-red-500"></i>
                        </a>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <h2> Pas de commentaires </h2>
        <?php endif; ?>
    </div>
</div>