<div class="wrap">

<h1><?php _e('CPT Relations', 'cpt-relations') ?></h1>
    <p>
	    <?= __('Creates CPTs: Jugadores, Equipos, Técnicos, Resultados, and Shortcodes', 'cpt-relations'); ?>
    </p>
    <hr>
    <h2>Shortcodes</h2>

    <hr>

    <section>
        <h3><?= __('For list teams specif category id', 'cpt-relations'); ?> </h3>
        <hr>
        <p>➜
		    <?= __('List teams category', 'cpt-relations'); ?> :
            <strong>
                [<?= CPT_REL_SHORT_LIST_TEAMS ?> cat=XX]
            </strong>
            <br>
            <i><?= __('Where id is the category id', 'cpt-relations'); ?></i>
        </p>
    </section>

    <section>
        <h3><?= __('For team specific page', 'cpt-relations'); ?> </h3>
        <hr>
        <p>➜
		    <?= __('List Team players', 'cpt-relations'); ?> :
            <strong>
                [<?= CPT_REL_SHORT_TEAM_PLAYERS ?>]
            </strong>
        </p>
        <p>➜
		    <?= __('List Team players in any page', 'cpt-relations'); ?> :
            <strong>
                [<?= CPT_REL_SHORT_TEAM_PLAYERS ?> equipo=XX]
            </strong>
            <br>
            <i><?= __('Where id is the cpt equipo id', 'cpt-relations'); ?></i>
        </p>

        <p>➜
		    <?= __('List Team coaches', 'cpt-relations'); ?> :
            <strong>
                [<?= CPT_REL_SHORT_TEAM_COACH ?>]
            </strong>
        </p>
    </section>

    <section>
        <h3><?= __('For list teams specif player', 'cpt-relations'); ?> </h3>
        <hr>
        <p>➜
		    <?= __('List player teams', 'cpt-relations'); ?> :
            <strong>
                [<?= CPT_REL_SHORT_PLAYER_TEAMS ?>]
            </strong>
        </p>
        <p>➜
			<?= __('List player teams specific in any page', 'cpt-relations'); ?> :
            <strong>
                [<?= CPT_REL_SHORT_PLAYER_TEAMS ?> jugador=XX]
            </strong>
            <br>
            <i><?= __('Where id is the player id', 'cpt-relations'); ?></i>
        </p>
    </section>

    <section>
        <h3><?= __('For list teams specif coach', 'cpt-relations'); ?> </h3>
        <hr>
        <p>➜
			<?= __('List coach teams', 'cpt-relations'); ?> :
            <strong>
                [<?= CPT_REL_SHORT_COACH_TEAMS ?>]
            </strong>
        </p>
        <p>➜
			<?= __('List coach teams specific in any page', 'cpt-relations'); ?> :
            <strong>
                [<?= CPT_REL_SHORT_COACH_TEAMS ?> tecnico=XX]
            </strong>
            <br>
            <i><?= __('Where id is the coach id', 'cpt-relations'); ?></i>
        </p>
    </section>