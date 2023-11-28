<h2>Liste des catégories.</h2>
<a href="newCategories.php"><button class="btn-add">Ajouter</button></a>

<table>
    <thead>
        <th>#</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Catégorie parente</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach ($categories as $c) { ?>
            <tr id="id<?= $c['id'] ?>">
                <td><?= $c['id'] ?></td>
                <td><?= $c['nom'] ?></td>
                <td><?= $c['description'] ?></td>
                <td><?= $c['parentId'] ?></td>
                <td>
                    <div class="flex">
                        <a href="editCategories.php?id=<?= $c['id'] ?>"><button class="btn-edit">Modifier</button></a>
                        <a href="deleteCategories.php?id=<?= $c['id'] ?>"><button class="btn-delete">Supprimer</button></a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script src="/public/js/ajax_delete_categories.js"></script>