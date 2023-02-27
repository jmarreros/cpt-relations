<?php
/**
 ** Class for saving relations between CPT in ACF
 **/

namespace cpt\rel\includes;

class Relations {

	public function __construct() {
		add_filter( 'acf/update_value/name=jugadores', [ $this, 'update_players_team' ], 10, 3 );
		add_filter( 'acf/update_value/name=equipos', [ $this, 'update_teams_player' ], 10, 3 );
	}

	// Update players for a specific team
	function update_players_team( $players, $team_id, $field ) {

		$global_name = 'is_updating_equipos';

		if ( ! empty( $GLOBALS[ $global_name ] ) ) {
			return $players;
		}

		// set global variable to avoid infinite loop
		$GLOBALS[ $global_name ] = 1;

		// Add new teams to the players
		if ( is_array( $players ) ) {
			foreach ( $players as $player ) {
				$teams = get_field( 'equipos', $player, false );
				if ( empty( $teams ) ) {
					$teams = array();
				}
				if ( in_array( $team_id, $teams ) ) {
					continue;
				}
				$teams[] = $team_id;

				update_field( 'equipos', $teams, $player );
			}
		}

		// Remove teams to the players
		$old_players = get_field( 'jugadores', $team_id, false );
		if ( is_array( $old_players ) ) {
			foreach ( $old_players as $player ) {
				if ( is_array( $players ) && in_array( $player, $players ) ) {
					continue;
				}
				$teams = get_field( 'equipos', $player, false );
				if ( empty( $teams ) ) {
					continue;
				}
				$pos = array_search( $team_id, $teams );
				unset( $teams[ $pos ] );

				update_field( 'equipos', $teams, $player );
			}
		}

		// reset global variable
		$GLOBALS[ $global_name ] = 0;

		return $players;
	}

	// Update teams for a specific player
	public function update_teams_player( $teams, $player_id, $field ) {

		$global_name = 'is_updating_jugadores';

		if ( ! empty( $GLOBALS[ $global_name ] ) ) {
			return $teams;
		}

		// set global variable to avoid infinite loop
		$GLOBALS[ $global_name ] = 1;

		// Add new players to the team
		if ( is_array( $teams ) ) {
			foreach ( $teams as $team ) {
				$players = get_field( 'jugadores', $team, false );
				if ( empty( $players ) ) {
					$players = array();
				}
				if ( in_array( $player_id, $players ) ) {
					continue;
				}
				$players[] = $player_id;

				update_field( 'jugadores', $players, $team );
			}
		}

		// Remove players to the team
		$old_teams = get_field( 'equipos', $player_id, false );
		if ( is_array( $old_teams ) ) {
			foreach ( $old_teams as $team ) {
				if ( is_array( $teams ) && in_array( $team, $teams ) ) {
					continue;
				}
				$players = get_field( 'jugadores', $team, false );
				if ( empty( $players ) ) {
					continue;
				}
				$pos = array_search( $player_id, $players );
				unset( $players[ $pos ] );

				update_field( 'jugadores', $players, $team );
			}
		}

		// reset global variable
		$GLOBALS[ $global_name ] = 0;

		return $teams;
	}

}

