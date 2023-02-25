<ul class="list-team-players">
	<?php
	/** @var array $players */
	foreach ( $players as $player ): ?>
        <li>
            <div class="player-image">
                <a href="<?= $player['url'] ?>">
					<?= $player['image'] ?>
                </a>
            </div>
            <span class="player-name">
                <a href="<?= $player['url'] ?>">
	                <?= $player['name'] ?>
                </a>
            </span>
        </li>
	<?php endforeach; ?>
</ul>
