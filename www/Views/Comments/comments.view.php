<!-- comments.view.php -->

<h1>Liste des commentaires</h1>

<?php if (!empty($comments)): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <strong>ID utilisateur:</strong> <?php echo $comment['user_id']; ?><br>
                <strong>ID page:</strong> <?php echo $comment['page_id']; ?><br>
                <strong>Contenu:</strong> <?php echo $comment['content']; ?><br>
                <strong>Date de création:</strong> <?php echo $comment['date_creation_publication']; ?><br>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun commentaire trouvé.</p>
<?php endif; ?>
<?php $this->component("dataTable", $dataTable); ?>
