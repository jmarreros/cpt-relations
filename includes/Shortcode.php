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
//		add_shortcode( CPT_REL_TEAMS_PLAYER, [ $this, 'show_teams_player' ] );
	}

	// Show list team players
	public function show_team_players( $atts, $content ) {
		$players = ( new DataCPT )->get_team_players();

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

//	// Teams by player
//	public function show_teams_player(){
//
//	}
}