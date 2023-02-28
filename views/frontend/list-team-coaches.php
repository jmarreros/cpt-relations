<section class="coaches-container">
    <ul class="coaches">
		<?php
		/** @var array $coaches */
		foreach ( $coaches as $coach ): ?>
            <li class="coach">
                <div class="coach-image">
                    <a href="<?= $coach['url'] ?>">
						<?= $coach['image'] ?>
                    </a>
                </div>
                <div class="coach-name">
                    <a href="<?= $coach['url'] ?>">
						<?= $coach['name'] ?>
                    </a>
                </div>
            </li>
		<?php endforeach; ?>
    </ul>
</section>
