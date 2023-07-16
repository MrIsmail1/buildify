<table class="<?= $config["config"]["class"] ?>" id="<?= $config["config"]["id"] ?>">
    <thead>
        <tr class="text-gray-600">
            <?php foreach ($config["headers"] as $header) : ?>
                <th><?= $header ?></th>
            <?php endforeach; ?>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($config['data'] as $row) : ?>
            <tr>
                <?php foreach ($config["tbody"] as $tb) : ?>
                    <td class="border-b border-gray-600"><?= $row[$tb] ?></td>
                <?php endforeach; ?>
                <td class="border-b border-gray-600">
                    <a href="<?= $config["actions"]["edit"] . $row['id'] ?>"><i class="fas fa-edit"></i></a>
                    <a href="<?= $config["actions"]["delete"] . $row['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                    <a href="/comments/add?page_id=<?= $row['id'] ?>"><i class="fas fa-comment"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $("<?= "#" . $config["config"]["id"] ?>").DataTable({
            ordering: false,
            paging: false,
            info: false,
        });
    });
</script>