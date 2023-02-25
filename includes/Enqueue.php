<?php

namespace cpt\rel\includes;

// Class for enqueue styles
class Enqueue {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
	}

	// Front-end scripts
	public function register_styles() {
		wp_register_style( 'style-cpt-rel', CPT_REL_URL . '/assets/style.css', [], CPT_REL_VERSION );
	}

}
