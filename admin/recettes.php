<?php
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/templates/nav.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/recettes.php";

adminOnly();

if (isset($_GET["page"])) {
    $page = (int)$_GET["page"];
} else {
    $page = 1;
}

$recettes = getRecettes($pdo, ADMIN_ITEM_LIMIT, $page);

$total = getTotalRecette($pdo);

$nbPages = ceil($total['total'] / ADMIN_ITEM_LIMIT);
?>
<div class="content">
    <h2>Liste des recettes</h2>
    <a href="/admin/newRecette.php"><button class="btn-add">Ajouter</button></a>

    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titre</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recettes as $r) { ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= $r['name'] ?></td>
                    <td>
                        <div class="flex">
                            <a href="editRecette.php?id=<?= $r['id'] ?>">
                                <button class="btn-edit">Modifier</button>
                            </a>
                            <a href="deleteRecette.php?id=<?= $r['id'] ?> " onclick="return confirm('Etes vous sur de vouloir supprimer cette article ?')">
                                <button class="btn btn-delete" data-id="<?= $r['id'] ?>">Supprimer</button>
                            </a>

                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <nav class="pagination">
        <ul class="list-pagination">
            <?php for ($i = 1; $i <= $nbPages; $i++) { ?>
                <li class="item-pagination <?php if ($i === $page) {
                                                echo 'active';
                                            } ?>"><a href="?page=<?= $i ?>"><?= $i ?></a></li>
            <?php } ?>
        </ul>
    </nav>
</div>
<?php
require_once __DIR__ . "/templates/footer.php";
?>