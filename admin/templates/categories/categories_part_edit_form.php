<h2>Modifier la catégorie.</h2>

<form action="" method="post" name="editCategorie">
    <div>
        <label for="name">Nom de la catégorie</label>
        <input type="text" name="name" id="name" value="<?= $cat['nom'] ?>">
    </div>
    <div>
        <label for="description">Description de la catégorie</label>
        <input type="text" name="description" id="description" value="<?= $cat['description'] ?>">
    </div>
    <div>
        <label for="categories">Ajouter une catégorie parente</label>
        <select name="categories" id="categories">
            <option value=""></option>
            <?php foreach ($categories as $c) { ?>
                <option value="<?= $c['id'] ?>" <?php if ($c['id'] == $cat['parentId']) {
                                                    echo 'selected';
                                                } ?>><?= $c['nom'] ?></option>
            <?php } ?>

        </select>
    </div>
    <div>
        <button type="submit" name="saveCategories" class="btn-edit">Modifier</button>
    </div>
</form>