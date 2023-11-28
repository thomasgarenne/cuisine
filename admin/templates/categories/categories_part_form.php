<h2>Ajouter une nouvelle catégorie.</h2>

<form action="" method="post" name="addCategorie">
    <div>
        <label for="name">Nom de la catégorie</label>
        <input type="text" name="name" id="name" placeholder="Nom" required>
    </div>
    <div>
        <label for="description">Description de la catégorie</label>
        <input type="text" name="description" id="description" placeholder="Description" required>
    </div>
    <div>
        <label for="name">Nom de la catégorie</label>
        <select name="categories" id="categories">
            <option value=""></option>
            <?php foreach ($categories as $c) { ?>
                <option value="<?= $c['id'] ?>"><?= $c['nom'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div>
        <button type="submit" name="saveCategorie" class="btn-add">Ajouter</button>
    </div>
</form>

<a href="<?= PREVIUS  ?>"><button>Retour</button></a>