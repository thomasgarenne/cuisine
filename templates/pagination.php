<nav class="pagination">
	<ul class="pagination-list">
		<li>
			<a href="<?= $url ?>/?page=<?= $currentPage - 1 ?>" class="<?= ($currentPage == 1) ? "disabled" : "" ?>">Précente</a>
		</li>
		<?php for ($page = 1; $page <= $pages; $page++) {
		?>
			<li>
				<a href="<?= $url ?>?page=<?= $page ?>" class="<?= ($currentPage == $page) ? "current" : "" ?>"><?= $page ?></a>
			</li>
		<?php } ?>
		<li>
			<a href="<?= $url ?>?page=<?= $currentPage + 1 ?>" class="<?= ($currentPage == $pages) ? "disabled" : "" ?>">Suivante</a>
		</li>
	</ul>
</nav>