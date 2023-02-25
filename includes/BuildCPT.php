<?php
/**
 ** Generic class for making CPT
 **/

namespace cpt\rel\includes;

class BuildCPT {
	protected array $types;

	// Create and configurate CPT
	function __construct() {

		$this->types = [
			"equipo"    => [
				"plural"     => "equipos",
				"icon"       => "dashicons-groups",
				"taxonomies" => [ 'category' ]
			],
			"jugador"   => [
				"plural"     => "jugadores",
				"icon"       => "dashicons-smiley",
				"taxonomies" => [ 'category' ]
			],
			"resultado" => [
				"plural" => "resultados",
				"icon"   => "dashicons-calendar-alt"
			],
			"técnico"   => [
				"plural" => "técnicos",
				"icon"   => "dashicons-editor-paste-text"
			]
		];

		// Add CPT
		add_action( 'init', [ $this, 'add_custom_post_types' ] );

		// Restrict Gutenberg CPT
		add_filter( 'use_block_editor_for_post_type', [ $this, 'disable_gutenberg_editor_cpt' ] , 10, 2);

	}


	// Generic CPT with parameters
	function add_custom_post_types() {

		foreach ( $this->types as $type => $data ) {

			$labels = array(
				'name'                  => _x( ucfirst( $type ), 'Post Type General Name', 'cpt-relations' ),
				'singular_name'         => _x( ucfirst( $type ), 'Post Type Singular Name', 'cpt-relations' ),
				'menu_name'             => __( ucfirst( $data['plural'] ), 'cpt-relations' ),
				'name_admin_bar'        => __( ucfirst( $data['plural'] ), 'cpt-relations' ),
				'archives'              => __( 'Archivo ' . $data['plural'], 'cpt-relations' ),
				'attributes'            => __( 'Atributos ' . $type, 'cpt-relations' ),
				'parent_item_colon'     => __( ucfirst( $data['plural'] ) . ' padre:', 'cpt-relations' ),
				'all_items'             => __( 'Todos', 'cpt-relations' ),
				'add_new_item'          => __( 'Agregar nuevo', 'cpt-relations' ),
				'add_new'               => __( 'Agregar', 'cpt-relations' ),
				'new_item'              => __( 'Nuevo', 'cpt-relations' ),
				'edit_item'             => __( 'Editar', 'cpt-relations' ),
				'update_item'           => __( 'Actualizar', 'cpt-relations' ),
				'view_item'             => __( 'Ver ' . $type, 'cpt-relations' ),
				'view_items'            => __( 'Ver ' . $data['plural'], 'cpt-relations' ),
				'search_items'          => __( 'Buscar ' . $type, 'cpt-relations' ),
				'insert_into_item'      => __( 'Insertar ' . $type, 'cpt-relations' ),
				'uploaded_to_this_item' => __( 'Subir ' . $type, 'cpt-relations' ),
				'items_list'            => __( 'Lista ' . $type, 'cpt-relations' ),
				'items_list_navigation' => __( 'Navegación ' . $data['plural'], 'cpt-relations' ),
				'filter_items_list'     => __( 'Filtro ' . $data['plural'], 'cpt-relations' ),
			);

			$rewrite = array(
				'slug'       => sanitize_title( $data['plural'] ),
				'with_front' => true,
				'pages'      => true,
				'feeds'      => true,
			);

			$args = array(
				'label'               => __( ucfirst( $type ), 'cpt-relations' ),
				'description'         => __( 'Contenido de ' . $data['plural'], 'cpt-relations' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'thumbnail' ),
				'taxonomies'          => $data['taxonomies'] ?? [],
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 5,
				'menu_icon'           => $data['icon'],
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => $data['has_archive'] ?? false,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'rewrite'             => $rewrite,
				'capability_type'     => 'page',
				'show_in_rest'        => true,
			);

			register_post_type( sanitize_title( $type ), $args );
		}
		flush_rewrite_rules();
	}

	// Disable Gutenberg for certain CPT
	public function disable_gutenberg_editor_cpt( $use_block_editor, $post_type ) {
		$post_types = array_map( 'sanitize_title', array_keys( $this->types ) );;
		if ( in_array( $post_type, $post_types ) ) {
			return false;
		}

		return $use_block_editor;
	}

}