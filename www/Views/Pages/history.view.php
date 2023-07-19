<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">titre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contenu</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de sauvgarde</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        <?php foreach ($history as $history) : ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($history['pagetitle']) ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($history['content']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($history['slug']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($history['save_date']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500 hover:underline"><a href=<?= "/bdfy-admin/pages/history/apply?id=" . $history["id"] ?>>Revenir vers cette version</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>