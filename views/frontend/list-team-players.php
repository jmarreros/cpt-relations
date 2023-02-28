<?php
/** @var array $players */

$positions = [
	'portero',
	'defensa',
	'centrocampista',
	'delantero',
];
?>

<section class="players-container">

    <ul class="list-positions">
		<?php foreach ( $positions as $position ) : ?>
            <li>
                <a href="#<?= $position ?>">
					<?= ucfirst( $position ) . 's' ?>
                </a>
            </li>
		<?php endforeach; ?>
    </ul>

	<?php foreach ( $positions as $position ) : ?>
		<?php
		$filter_players = array_filter( $players, fn( $player ) => $player['position'] == $position );
		?>
        <div class="title-position" id="<?= $position ?>"><?= ucfirst( $position ) . 's' ?></div>

        <ul class="players">
			<?php foreach ( $filter_players as $player ): ?>
                <li class="player">
                    <div class="player-image">
                        <a href="<?= $player['url'] ?>">
							<?= $player['image'] ?>
                        </a>
                    </div>
                    <div class="player-name">
                        <a href="<?= $player['url'] ?>">
							<?= $player['number'] ? $player['number'] . ' - ' : '' ?>
							<?= ucwords( $player['name'] ) ?>
                            <span class="player-position">
                                <?= $player['position'] ?>
                            </span>
                        </a>
                    </div>
                </li>
			<?php endforeach; ?>
        </ul>

	<?php endforeach; ?>

</section>
