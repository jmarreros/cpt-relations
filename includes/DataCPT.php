<?php
/**
 ** Generic class for getting data CPT
 **/

namespace cpt\rel\includes;

class  DataCPT {

	// Get team players
	public function get_team_players(): array {
		global $post;
		$items = get_field( 'jugadores', $post->ID );

		$players = [];

		foreach ( $items as $item ) {
			$players[ $item->ID ] = [
				'name'  => $item->post_title,
				'url'   => get_permalink( $item->ID ),
				'image' => $this->get_image_cpt( $item->ID, 'wpcf-foto' )
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
	private function get_image_cpt( $id, $field_name, $size = 'thumbnail' ): string {
		$thumbnail = get_the_post_thumbnail( $id, $size );

		if ( ! $thumbnail ) {
			$id_value  = get_field( $field_name, $id );
			$thumbnail = wp_get_attachment_image( intval( $id_value ), $size );
		}

		return $thumbnail;
	}
}