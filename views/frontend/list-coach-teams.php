<div class="coach-teams-container">
    <ul class="coach-teams">
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
