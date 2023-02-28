<div class="player-teams-container">
    <ul class="player-teams">
		<?php
		/** @var array $teams */
		foreach ( $teams as $team ): ?>
            <li>
                <span class="team-name">
                    <a href="<?= $team['url'] ?>">
                        <?= $team['name'] ?>
                    </a>
                </span>
            </li>
		<?php endforeach; ?>
    </ul>
</div>
