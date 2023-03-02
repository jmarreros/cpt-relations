<ul class="list-results">
	<?php
	/** @var array $results */
	foreach ( $results as $result ): ?>
		<li>
			<div class="team-image">
				<a href="<?= $result['url'] ?>">
					<?= $result['image'] ?>
				</a>
			</div>
			<span class="team-name">
                <a href="<?= $result['url'] ?>">
	                <?= $result['name'] ?>
                </a>
            </span>
		</li>
	<?php endforeach; ?>
</ul>


<div>
    <?php
    /** @var string $pagination */
    echo $pagination;
    ?>
</div>