<div class="container-score">
	<?php /** @var array $result */
	foreach ( $result['score'] as $key => $info ): ?>
		<div class="team-<?= $key ?>">
			<div class="team-name">
				<?php if ( $info['url'] ): ?>
					<a href="<?= $info['url'] ?> "> <?= $info['name'] ?> </a>
				<?php else: ?>
					<span><?= $info['name'] ?></span>
				<?php endif; ?>
			</div>
			<div class="team-score">
				<span><?= $info['score'] ?></span>
			</div>
		</div>
	<?php endforeach; ?>
</div>