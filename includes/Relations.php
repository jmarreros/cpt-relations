<?php
/**
 ** Class for saving relations between CPT in ACF
 **/

namespace cpt\rel\includes;

class Relations {

	public function __construct() {
		add_filter( 'acf/update_value/name=jugadores', [ $this, 'update_players_team' ], 10, 2 );
		add_filter( 'acf/update_value/name=equipos', [ $this, 'update_teams_player' ], 10, 2 );
	}

	// Update players for a specific team
	function update_players_team( $players, $team_id ) {
		return $this->update_elements_cpt( $players, 'jugadores', $team_id, 'equipos' );
	}

	// Update teams for a specific player
	public function update_teams_player( $teams, $player_id ) {
		return $this->update_elements_cpt( $teams, 'equipos', $player_id, 'jugadores' );
	}

	// Generic update elementes cpt acf relation field
	private function update_elements_cpt( $elements, $field_name, $cpt_id, $field_name_rel ) {
		$global_name = 'is_updating_' . $field_name;

		if ( ! empty( $GLOBALS[ $global_name ] ) ) {
			return $elements;
		}

		// set global variable to avoid infinite loop
		$GLOBALS[ $global_name ] = 1;

		// Add new teams to the players
		if ( is_array( $elements ) ) {
			foreach ( $elements as $element ) {
				$values = get_field( $field_name_rel, $element, false );
				if ( empty( $values ) ) {
					$values = array();
				}
				if ( in_array( $cpt_id, $values ) ) {
					continue;
				}
				$values[] = $cpt_id;

				update_field( $field_name_rel, $values, $element );
			}
		}

		// Remove teams to the players
		$old_elements = get_field( $field_name, $cpt_id, false );
		if ( is_array( $old_elements ) ) {
			foreach ( $old_elements as $element ) {
				if ( is_array( $elements ) && in_array( $element, $elements ) ) {
					continue;
				}
				$values = get_field( $field_name_rel, $element, false );
				if ( empty( $values ) ) {
					continue;
				}
				$pos = array_search( $cpt_id, $values );
				unset( $values[ $pos ] );

				update_field( $field_name_rel, $values, $element );
			}
		}

		// reset global variable
		$GLOBALS[ $global_name ] = 0;

		return $elements;
	}
}
