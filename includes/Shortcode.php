<?php

namespace cpt\rel\includes;

/**
 * Class for creating the shortcodes
 */
class Shortcode {
	//constructor
	public function __construct() {
		add_action( 'init', [ $this, 'create_shortcodes' ] );
	}

	// Create shortcode
	public function create_shortcodes() {
		wp_enqueue_style( 'style-cpt-rel' );
		add_shortcode( CPT_REL_SHORT_TEAM_PLAYERS, [ $this, 'show_team_players' ] );
		add_shortcode( CPT_REL_SHORT_TEAM_COACH, [ $this, 'show_team_coaches' ] );
		add_shortcode( CPT_REL_SHORT_LIST_TEAMS, [ $this, 'show_teams' ] );
		add_shortcode( CPT_REL_PLAYER_TEAMS, [ $this, 'show_player_teams' ] );
	}

	// Show list team players
	public function show_team_players( $atts, $content ) {
		$id_team = intval( $atts['equipo'] ?? 0 );

		$players = ( new DataCPT )->get_team_players( $id_team );

		ob_start();
		include_once CPT_REL_PATH . '/views/frontend/list-team-players.php';
		$html_code = ob_get_contents();
		ob_end_clean();

		return $html_code;
	}

	// Show list team couches
	public function show_team_coaches( $atts, $content ) {
		$coaches = ( new DataCPT )->get_team_coaches();

		ob_start();
		include_once CPT_REL_PATH . '/views/frontend/list-team-coaches.php';
		$html_code = ob_get_contents();
		ob_end_clean();

		return $html_code;
	}

	// Show teams with atts category
	public function show_teams( $atts, $content ) {
		$category = intval( $atts['cat'] ?? 0 );
		$teams    = ( new DataCPT )->get_teams_specific_category( $category );

		ob_start();
		include_once CPT_REL_PATH . '/views/frontend/list-teams.php';
		$html_code = ob_get_contents();
		ob_end_clean();

		return $html_code;
	}

	// Show teams by specific player
	public function show_player_teams($atts, $content){
		$id_player = intval( $atts['jugador'] ?? 0 );
		$teams    = ( new DataCPT )->get_teams_specific_user( $id_player );

		ob_start();
		include_once CPT_REL_PATH . '/views/frontend/list-player-teams.php';
		$html_code = ob_get_contents();
		ob_end_clean();

		return $html_code;
	}

}