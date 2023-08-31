<form method="<?= htmlspecialchars($config["config"]["method"] ?? "GET") ?>" action="<?= htmlspecialchars($config["config"]["action"]) ?>" autocomplete="<?= htmlspecialchars($config["config"]["autocomplete"]) ?>" class="<?= htmlspecialchars($config["config"]["class"]) ?>">
    <?php foreach ($config["inputs"] as $name => $input) : ?>
        <?php $label = $config["labels"][$name]; ?>
        <?php $for = $name; ?>
        <?php if ($input["type"] == "select") : ?>
            <label for="<?= htmlspecialchars($for) ?>" class="<?= htmlspecialchars($label["class"]) ?>"> <?= htmlspecialchars($label["text"]) ?></label>
            <select name="<?= htmlspecialchars($name) ?>">
                <?php foreach ($input["options"] as $value => $label) : ?>
                    <option value="<?= htmlspecialchars($value) ?>" <?php if ($value == $input["value"]) echo "selected"; ?>>
                        <?= htmlspecialchars($label) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php else : ?>
            <div>
                <?php if (isset($config["resetPwd"]) && $input["type"] === "password") : ?>
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="<?= htmlspecialchars($for) ?>" class="<?= htmlspecialchars($label["class"]) ?>"> <?= htmlspecialchars($label["text"]) ?></label>
                            <div class="text-sm">
                                <a href="<?= htmlspecialchars($config["resetPwd"]) ?>" class="font-semibold text-indigo-600 hover:text-indigo-500">Mot de passe oubliée</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input name="<?= htmlspecialchars($name) ?>" type="<?= htmlspecialchars($input["type"]) ?>" placeholder=" <?= htmlspecialchars($input["placeholder"]) ?>" class="<?= htmlspecialchars($input["class"]) ?>">
                        </div>
                    </div>
                <?php elseif ($input["type"] === "textarea") : ?>
                    <div>
                        <label for="<?= htmlspecialchars($for) ?>" class="<?= htmlspecialchars($label["class"]) ?>"> <?= htmlspecialchars($label["text"]) ?> </label>
                        <div class=" mt-2">
                            <textarea name="<?= htmlspecialchars($name) ?>" id="<?= htmlspecialchars($input["id"]) ?>" rows="<?= htmlspecialchars($input["rows"]) ?>" cols="<?= htmlspecialchars($input["cols"]) ?>" class="<?= htmlspecialchars($input["class"]) ?>" <?php if (isset($input["value"])) : ?> value="<?= htmlspecialchars($input["value"]) ?>" <?php endif ?>> <?= htmlspecialchars($input["value"] ?? "") ?> </textarea>
                        </div>
                    </div>
                <?php elseif ($input["type"] == "checkbox") : ?>
                    <div>
                        <input id="<?= htmlspecialchars($for) ?>" name="<?= htmlspecialchars($name) ?>" type="<?= htmlspecialchars($input["type"]) ?>" value="<?= htmlspecialchars($input["value"]) ?>" class="<?= htmlspecialchars($input["class"]) ?>" <?php if ($input["checked"]) : ?> checked <?php endif ?>>
                        <label for="<?= htmlspecialchars($for) ?>" class="<?= htmlspecialchars($label["class"]) ?>"><?= htmlspecialchars($label["text"]) ?></label>
                    </div>
                <?php else : ?>
                    <div>
                        <label for="<?= htmlspecialchars($for) ?>" class="<?= htmlspecialchars($label["class"]) ?>"><?= htmlspecialchars($label["text"]) ?></label>
                        <div class="mt-2">
                            <input name="<?= htmlspecialchars($name) ?>" type="<?= htmlspecialchars($input["type"]) ?>" placeholder=" <?= htmlspecialchars($input["placeholder"]) ?>" <?php if (isset($input["value"])) : ?> value="<?= htmlspecialchars($input['value']) ?>" <?php endif ?> class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" class="<?= htmlspecialchars($config["config"]["buttonClass"]) ?>" value="<?= htmlspecialchars($config["config"]["submit"]) ?>">
</form>
<script>
    ClassicEditor.create(document.querySelector('#content')).catch((error) => {
        console.error(error);
    });
</script>