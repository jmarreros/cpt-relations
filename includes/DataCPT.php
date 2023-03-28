<?php
/**
 ** Generic class for getting data CPT
 **/

namespace cpt\rel\includes;

use WP_Query;

class  DataCPT {

	// Get team players
	public function get_team_players( $id_team ): array {
		global $post;

		$id_team = $id_team ?: $post->ID;
		$items   = get_field( 'jugadores', $id_team );

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


	// Get team specific user ID, team is a field of player
	public function get_teams_specific_user( $id_user ): array {
		global $post;
		$id_user = $id_user ?: $post->ID;

		$items = get_field( 'equipos', $id_user );

		$teams = [];
		foreach ( $items as $team ) {
			$teams[ $team->ID ] = [
				'name'  => $team->post_title,
				'url'   => get_permalink( $team->ID ),
				'image' => get_the_post_thumbnail( $team->ID, 'thumbnail' )
			];
		}

		return $teams;
	}

	// Get team specific coach ID, team is a field of coach
	public function get_teams_specific_coach( $id_coach ): array {
		global $post;
		$id_coach = $id_coach ?: $post->ID;

		$items = get_field( 'equipos-tecnico', $id_coach );

		$teams = [];
		foreach ( $items as $team ) {
			$teams[ $team->ID ] = [
				'name'  => $team->post_title,
				'url'   => get_permalink( $team->ID ),
				'image' => get_the_post_thumbnail( $team->ID, 'thumbnail' )
			];
		}

		return $teams;
	}

	// Get match results with pagination
	public function get_match_results(): array {

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$args  = array(
			'posts_per_page' => get_option( 'posts_per_page' ),
			'paged'          => $paged,
			'post_type'      => 'resultado',
			'orderby'        => 'date',
			'order'          => 'DESC',
		);

		$items = new WP_Query( $args );

		$results = [];
		foreach ( $items->posts as $item ) {
			$results[ $item->ID ] = [
				'name'    => $item->post_title,
				'url'     => get_permalink( $item->ID ),
				'image'   => get_the_post_thumbnail( $item->ID, 'thumbnail' ),
				'score'   => dcms_get_info_teams_match( $item->ID ),
			];
		}

		$pagination = paginate_links(
			array(
				'current' => max( 1, get_query_var( 'paged' ) ),
				'total'   => $items->max_num_pages
			)
		);

		wp_reset_query();

		$data['results']    = $results;
		$data['pagination'] = $pagination;

		return $data;
	}

	// Get final score
	public function get_final_score($id_result) : array{
		return dcms_get_info_teams_match( $id_result );
	}

}