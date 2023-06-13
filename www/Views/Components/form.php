<form method="<?= $config["config"]["method"] ?? "GET" ?>" action="<?= $config["config"]["action"] ?>" autocomplete="<?= $config["config"]["autocomplete"] ?>" class="<?= $config["config"]["class"] ?>">
    <?php foreach ($config["inputs"] as $name => $input) : ?>
        <?php $label = $config["labels"][$name]; ?>
        <?php $for = $name; ?>
        <?php if ($input["type"] == "select") : ?>
            <select name="<?= $name; ?>">
                <?php foreach ($input["options"] as $option) : ?>
                    <option><?= $option; ?></option>
                <?php endforeach; ?>
            </select>
        <?php else : ?>
            <div>
                <?php if (isset($config["resetPwd"]) && $input["type"] === "password") : ?>
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="<?= $for; ?> " class="block text-sm font-medium leading-6 text-gray-900"><?= $label["text"] ?></label>
                            <div class="text-sm">
                                <a href="<?= $config["resetPwd"] ?>" class="font-semibold text-indigo-600 hover:text-indigo-500">Mot de passe oubliée</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input name="<?= $name; ?>" type="<?= $input["type"] ?>" placeholder=" <?= $input["placeholder"] ?>" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                <?php else : ?>
                    <div>
                        <label for="<?= $for; ?> " class="block text-sm font-medium leading-6 text-gray-900"><?= $label["text"] ?></label>
                        <div class="mt-2">
                            <input name="<?= $name; ?>" type="<?= $input["type"] ?>" placeholder=" <?= $input["placeholder"] ?>" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" value="<?= $config["config"]["submit"] ?>">
</form>