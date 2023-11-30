<div class="flash-message" id="flash-message"></div>

<h2>Liste des commentaires</h2>

<table>
    <thead>
        <tr>
            <th>Commentaires</th>
            <th>Notes</th>
            <th>Auteur</th>
            <th>Recette</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commentaires as $c) { ?>
            <tr id="id<?= $c['userId'] ?>">
                <td><?= $c['commentaire'] ?></td>
                <td><?= $c['notes'] ?></td>
                <td><?= $c['username'] ?></td>
                <td><?= $c['recetteId'] ?></td>
                <td>
                    <div class="flex">
                        <a href="/admin/commentaires/editCommentaire.php?userId=<?= $c['userId'] ?>&recetteId=<?= $c['recetteId'] ?>">
                            <button class="btn-edit">Modifier</button>
                        </a>
                        <a href="/admin/commentaires/deleteCommentaire.php?userId=<?= $c['userId'] ?>&recetteId=<?= $c['recetteId'] ?>">
                            <button class="btn-delete">Supprimer</button>
                        </a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script src="/public/js/commentaire_delete_ajax.js"></script>
<script src="/public/js/flash_message.js"></script>