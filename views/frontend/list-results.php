<ul class="list-results">
	<?php
	/** @var array $results */
	foreach ( $results as $result ): ?>
        <li>
            <div class="result-name">
                <a href="<?= $result['url'] ?>">
	                <?= $result['name'] ?>
                </a>
            </div>

            <div class="result-image">
                <a href="<?= $result['url'] ?>">
			        <?= $result['image'] ?>
                </a>
            </div>

	        <?php include ("score-result.php") ?>

        </li>
	<?php endforeach; ?>
</ul>


<div class="pagination-results">
	<?php
	/** @var string $pagination */
	echo $pagination;
	?>
</div>