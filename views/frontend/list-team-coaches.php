<section class="list-team-coaches">
	<?php
	/** @var array $coaches */
	foreach ( $coaches as $coach ): ?>
        <li>
            <div class="coach-image">
                <a href="<?= $coach['url'] ?>">
					<?= $coach['image'] ?>
                </a>
            </div>
            <span class="coach-name">
                <a href="<?= $coach['url'] ?>">
	                <?= $coach['name'] ?>
                </a>
            </span>
        </li>
	<?php endforeach; ?>
</section>
