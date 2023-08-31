<table class="<?= htmlspecialchars($config["config"]["class"]) ?>" id="<?= htmlspecialchars($config["config"]["id"]) ?>">
    <thead class="bg-gray-200">
        <tr class="text-gray-600">
            <?php foreach ($config["headers"] as $header) : ?>
                <th class="py-2 px-4"><?= htmlspecialchars($header) ?></th>
            <?php endforeach; ?>
            <th class="py-2 px-4">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($config['data'] as $row) : ?>
            <tr>
                <?php foreach ($config["tbody"] as $tb) : ?>
                    <td class="border-b border-gray-300 py-2 px-4">
                        <?php if ($tb === "pagetitle" && isset($row["slug"])) : ?>
                            <a href="<?= "/" . htmlspecialchars($row["slug"]) ?>" class="underline text-blue-500 hover:text-blue-800"><?= htmlspecialchars($row[$tb]) ?></a>
                        <?php elseif ($tb === "last_modified") : ?>
                            <?php $date = new \DateTime(htmlspecialchars($row["last_modified"])); ?>
                            <?= htmlspecialchars($date->format('Y-m-d')) ?>
                        <?php else : ?>
                            <?= htmlspecialchars($row[$tb]) ?>
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
                <td class="border-b border-gray-300 py-2 px-4">
                    <?php if (isset($config["actions"]["view"])) : ?>
                        <a href="<?= htmlspecialchars($config["actions"]["view"] . $row['id']) ?>" class="text-blue-500 hover:text-blue-700"><i class="fas fa-eye"></i></a>
                    <?php endif; ?>

                    <?php if (isset($config["actions"]["edit"])) : ?>
                        <a href="<?= htmlspecialchars($config["actions"]["edit"] . $row['id']) ?>" class="text-yellow-500 hover:text-yellow-700 ml-2"><i class="fas fa-edit"></i></a>
                    <?php endif; ?>

                    <?php if (isset($config["actions"]["delete"])) : ?>
                        <a href="<?= htmlspecialchars($config["actions"]["delete"] . $row['id']) ?>" class="text-red-500 hover:text-red-700 ml-2"><i class="fas fa-trash-alt"></i></a>
                    <?php endif; ?>

                    <?php if (isset($config["actions"]["comment"])) : ?>
                        <a href="<?= htmlspecialchars($config["actions"]["comment"] . $row['id']) ?>" class="text-green-500 hover:text-green-700 ml-2"><i class="fas fa-comment"></i></a>
                    <?php endif; ?>

                    <?php if (isset($config["actions"]["report"])) : ?>
                        <a href="<?= htmlspecialchars($config["actions"]["report"] . $row['id']) ?>" class="text-orange-500 hover:text-orange-700 ml-2"><i class="fas fa-exclamation-triangle"></i></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $("<?= "#" . htmlspecialchars($config["config"]["id"]) ?>").DataTable({
            ordering: false,
            paging: true,
            info: false,
        });
    });
</script>