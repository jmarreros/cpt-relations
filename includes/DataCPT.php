<?php
/**
 ** Generic class for getting data CPT
 **/

namespace cpt\rel\includes;

use WP_Query;

class  DataCPT {

	// Get team players
	public function get_team_players(): array {
		global $post;
		$items = get_field( 'jugadores', $post->ID );

		$players = [];

		foreach ( $items as $item ) {
			$players[ $item->ID ] = [
				'name'     => $item->post_title,
				'position' => get_field( 'wpcf-posicion', $item->ID ),
				'number'   => get_field( 'numero', $item->ID ),
				'url'      => get_permalink( $item->ID ),
				'image'    => $this->get_image_cpt( $item->ID, 'wpcf-foto' )
			];
		}

		return $players;
	}

	// Get team coaches
	public function get_team_coaches(): array {
		global $post;
		$items = get_field( 'tecnicos', $post->ID );

		$coaches = [];

		foreach ( $items as $item ) {
			$coaches[ $item->ID ] = [
				'name'  => $item->post_title,
				'url'   => get_permalink( $item->ID ),
				'image' => $this->get_image_cpt( $item->ID, 'wpcf-foto-tecnico' )
			];
		}

		return $coaches;
	}

	// Get featured image or ACF with image
	private function get_image_cpt( $id, $field_name ): string {
		$thumbnail = get_the_post_thumbnail( $id, 'medium' );

		if ( ! $thumbnail ) {
			$id_value  = get_field( $field_name, $id );
			$thumbnail = wp_get_attachment_image( intval( $id_value ) );
		}

		return $thumbnail;
	}

	// Get teams specific category id
	public function get_teams_specific_category( $id_category ): array {
		$args  = array(
			'post_type'   => 'equipo',
			'post_status' => 'publish',
			'tax_query'   => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $id_category,
				),
			),
		);
		$query = new WP_Query( $args );

		$teams = [];
		foreach ( $query->posts as $team ) {
			$teams[ $team->ID ] = [
				'name'  => $team->post_title,
				'url'   => get_permalink( $team->ID ),
				'image' => get_the_post_thumbnail( $team->ID, 'thumbnail' )
			];
		}

		return $teams;
	}


	// Get team specific user ID
//	public function get_teams_specific_user(){
//
//	}

}