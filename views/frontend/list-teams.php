<ul class="list-teams">
	<?php
	/** @var array $teams */
	foreach ( $teams as $team ): ?>
		<li>
			<div class="team-image">
				<a href="<?= $team['url'] ?>">
					<?= $team['image'] ?>
				</a>
			</div>
			<span class="team-name">
                <a href="<?= $team['url'] ?>">
	                <?= $team['name'] ?>
                </a>
            </span>
		</li>
	<?php endforeach; ?>
</ul>
