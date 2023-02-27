<?php
/*
Plugin Name: Custom Custom Post Type Relations
Plugin URI: https://decodecms.com
Description: Plugin for CPT relations, creates CPT and shortcodes to show info
Version: 1.0
Author: Jhon Marreros Guzmán
Author URI: https://decodecms.com
Text Domain: cpt-relations
Domain Path: languages
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

namespace cpt\rel;

use cpt\rel\includes\Submenu;
use cpt\rel\includes\BuildCPT;
use cpt\rel\includes\Enqueue;
use cpt\rel\includes\Shortcode;
use cpt\rel\includes\Relations;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin class to handle settings constants and loading files
 **/
final class Loader {

	// Define all the constants we need
	public function define_constants() {
		define( 'CPT_REL_VERSION', '1.0' );
		define( 'CPT_REL_PATH', plugin_dir_path( __FILE__ ) );
		define( 'CPT_REL_URL', plugin_dir_url( __FILE__ ) );
		define( 'CPT_REL_BASE_NAME', plugin_basename( __FILE__ ) );
		define( 'CPT_REL_SUBMENU', 'tools.php' );

		// Shortcodes
		define( 'CPT_REL_SHORT_TEAM_PLAYERS'  , 'equipo_jugadores' );
		define( 'CPT_REL_SHORT_TEAM_COACH'  , 'equipo_tecnicos' );
		define( 'CPT_REL_SHORT_LIST_TEAMS'  , 'equipos' );
		define( 'CPT_REL_TEAMS_PLAYER'  , 'equipos_jugador' );

	}

	// Load all the files we need
	public function load_includes() {
		include_once( CPT_REL_PATH . '/helpers/functions.php' );
		include_once( CPT_REL_PATH . '/includes/Submenu.php' );
		include_once( CPT_REL_PATH . '/includes/BuildCPT.php' );
		include_once( CPT_REL_PATH . '/includes/Enqueue.php' );
		include_once( CPT_REL_PATH . '/includes/Shortcode.php' );
		include_once( CPT_REL_PATH . '/includes/DataCPT.php' );
		include_once( CPT_REL_PATH . '/includes/Relations.php' );
	}

	// Load tex domain
	public function load_domain() {
		add_action( 'plugins_loaded', function () {
			$path_languages = dirname( CPT_REL_BASE_NAME ) . '/languages/';
			load_plugin_textdomain( 'cpt-relations', false, $path_languages );
		} );
	}

	// Add link to plugin list
	public function add_link_plugin() {
		add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), function ( $links ) {
			return array_merge( array(
				'<a href="' . esc_url( admin_url( CPT_REL_SUBMENU . '?page=cpt-relations' ) ) . '">' . __( 'Settings', 'cpt-relations' ) . '</a>'
			), $links );
		} );
	}

	// Initialize all
	public function init() {
		$this->define_constants();
		$this->load_includes();
		$this->load_domain();
		$this->add_link_plugin();
		new SubMenu;
		new BuildCPT;
		new Enqueue;
		new Shortcode;
		new Relations;
	}

}

( new Loader() )->init();


