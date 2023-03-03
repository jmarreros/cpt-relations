<?php

// Function to get info teams according to selection team or input manually
function dcms_get_info_teams_match( $id_match ): array {
	$meta = get_post_meta( $id_match );

	$is_selected_guest_club = intval( $meta['visitante_juventud_estadio'][0] ?? 0 );
	$is_selected_local_club = intval( $meta['local_juventud_estadio'][0] ?? 0 );

	$info = [];

	// Local info
	if ( $is_selected_local_club ) {
		$id_team               = intval( $meta['rel_equipo_local'][0] ?? 0 );
		$info['local']['name'] = get_post( $id_team )->post_title;
		$info['local']['url']  = get_permalink( $id_team );
	} else { // manual input
		$info['local']['name'] = $meta['wpcf-equipo-local'][0] ?? '';
		$info['local']['url']  = '';
	}
	$info['local']['score'] = $meta['wpcf-resultado-local'][0] ?? 0;

	// Guest info
	if ( $is_selected_guest_club ) {
		$id_team               = intval( $meta['rel_equipo_visitante'][0] ?? 0 );
		$info['guest']['name'] = get_post( $id_team )->post_title;
		$info['guest']['url']  = get_permalink( $id_team );
	} else { // manual input
		$info['guest']['name'] = $meta['wpcf-equipo-visitante'][0] ?? '';
		$info['guest']['url']  = '';
	}
	$info['guest']['score'] = $meta['wpcf-resultado-visitante'][0] ?? 0;

	return $info;
}
