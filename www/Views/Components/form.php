<form method="<?= $config["config"]["method"] ?? "GET" ?>" action="<?= $config["config"]["action"] ?>" autocomplete="<?= $config["config"]["autocomplete"] ?>" class="<?= $config["config"]["class"] ?>">
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
                            <label for="<?= $for; ?> " class="<?= $label["class"] ?>" <?= $label["text"] ?></label>
                                <div class="text-sm">
                                    <a href="<?= $config["resetPwd"] ?>" class="font-semibold text-indigo-600 hover:text-indigo-500">Mot de passe oubliée</a>
                                </div>
                        </div>
                        <div class="mt-2">
                            <input name="<?= $name; ?>" type="<?= $input["type"] ?>" placeholder=" <?= $input["placeholder"] ?>" class="<?= $input["class"] ?>">
                        </div>
                    </div>
                <?php else : ?>
                    <div>
                        <label for="<?= $for; ?> " class="<?= $label["class"] ?>"><?= $label["text"] ?></label>
                        <div class="mt-2">
                            <input name="<?= $name; ?>" type="<?= $input["type"] ?>" placeholder=" <?= $input["placeholder"] ?>" <?php if (isset($input["value"])) : ?> value="<?= $input['value'] ?>" <?php endif ?> class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if (isset($config["content"])) : ?>
        <div class="mt-2">
            <label for="<?= $config["content"]["id"] ?> " class="<?= $label["class"] ?>"><?= $config["content"]["label"] ?> </label>
            <div class=" mt-2">
                <textarea name="<?= $config["content"]["id"] ?>" id="<?= $config["content"]["id"] ?>" rows="<?= $config["content"]["rows"] ?>" cols="<?= $config["content"]["cols"] ?>" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" <?php if (isset($config["content"]["value"])) : ?> value="<?= $config["content"]["value"] ?>" <?php endif ?>></textarea>
            </div>
        </div>
    <?php endif; ?>
    <input type="submit" name="submit" class="<?= $config["config"]["buttonClass"] ?>" value="<?= $config["config"]["submit"] ?>">
</form>
<script>
    $data = 
    ClassicEditor
        .create(document.querySelector('#content')).then(editor => {editor.setData("".)})
        .catch(error => {
            console.error(error);
        });
</script>