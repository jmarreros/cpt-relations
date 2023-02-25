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
		add_shortcode( CPT_REL_SHORT_TEAM_PLAYERS, [ $this, 'show_team_players' ] );
		add_shortcode( CPT_REL_SHORT_TEAM_COACH, [ $this, 'show_team_coaches' ] );
	}

	// Show list team players
	public function show_team_players( $atts, $content ) {

		wp_enqueue_style( 'style-cpt-rel' );

		$players = ( new DataCPT )->get_team_players();

		ob_start();
		include_once CPT_REL_PATH . '/views/frontend/list-team-players.php';
		$html_code = ob_get_contents();
		ob_end_clean();

		return $html_code;
	}

	// Show list team couches
	public function show_team_coaches($atts, $content) {
		wp_enqueue_style( 'style-cpt-rel' );

		$coaches = ( new DataCPT )->get_team_coaches();

		ob_start();
		include_once CPT_REL_PATH . '/views/frontend/list-team-coaches.php';
		$html_code = ob_get_contents();
		ob_end_clean();

		return $html_code;
	}

}