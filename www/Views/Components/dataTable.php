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
                    <?php if (isset($config["actions"]["view"])) : ?>
                            <a href="<?= $config["actions"]["view"] . $row['id'] ?>"><i class="fas fa-eye"></i></a>
                    <?php endif;?>

                    <?php if (isset($config["actions"]["edit"])) : ?>
                            <a href="<?= $config["actions"]["edit"] . $row['id'] ?>"><i class="fas fa-edit"></i></a>
                    <?php endif;?>

                    <?php if (isset($config["actions"]["delete"])) : ?>
                            <a href="<?= $config["actions"]["delete"] . $row['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                    <?php endif;?>

                    <?php if (isset($config["actions"]["comment"])) : ?>
                            <a href="<?= $config["actions"]["comment"] . $row['id'] ?>"><i class="fas fa-comment"></i></a>
                    <?php endif;?>

                    <?php if (isset($config["actions"]["report"])) : ?>
                            <a href="<?= $config["actions"]["report"] . $row['id'] ?>"><i class="fas fa-exclamation-triangle"></i></a>                        
                    <?php endif;?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $("<?= "#" . $config["config"]["id"] ?>").DataTable({
            ordering: false,
            paging: true,
            info: false,
        });
    });
</script>