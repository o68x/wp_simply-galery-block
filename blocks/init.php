<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function pgc_sgb_frontend_scripts(){
	$slug = 'pgc-simply-gallery-block';
	$version = '1.1.4';
	
	 /** Parser */
	 wp_enqueue_script(
		$slug . '-script',
		plugins_url( '/blocks/pgc_sgb.min.js', dirname( __FILE__ ) ),
		false,
		$version,
		true
	);

	/** Skins List */
	$skinsList = array();
	$skins_folders = glob(realpath( dirname( __FILE__ ) ) . '/skins/*.js');
	foreach ( $skins_folders as $file ) {
		$fileName = substr($file,strrpos($file,"/")+1);
		$skinsList[substr($fileName,0,-3)] = plugins_url( '/blocks/skins/', dirname( __FILE__ ) ).$fileName.'?ver='.$version; 
  	}
 
	wp_localize_script( $slug.'-script', 'PGC_SGB',
			array(
				'ajaxurl'   => admin_url( 'admin-ajax.php' ),
				'assets' => plugins_url('/assets/',dirname( __FILE__ )),
				'skinsFolder' => plugins_url('/blocks/skins/',dirname( __FILE__ )), 
				'skinsList' => $skinsList,  /** Skins List */
				'admin' => is_admin()
			)
		);
}

function simply_gallery_block_assets() {
	$slug = 'pgc-simply-gallery-block'; //Name Space
	$version = '1.1.4';

	wp_register_style(
		$slug.'-frontend', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		array(), // Dependency to include the CSS after it.
		$version
	);

	wp_register_script(
		$slug.'-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		$version,
		true // Enqueue the script in the footer.
	);
	
	// wp_register_style(
	// 	$slug.'-editor', // Handle.
	// 	plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
	// 	array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
	// 	$version
	// );
	
	register_block_type(
		'pgcsimplygalleryblock/masonry', 
		array(
			'style'         => $slug.'-frontend',
			'editor_script' => $slug.'-js',
			'editor_style'  => $slug.'-editor',
		)
	);
	register_block_type(
		'pgcsimplygalleryblock/justified', 
		array(
			'style'         => $slug.'-frontend',
			'editor_script' => $slug.'-js',
			'editor_style'  => $slug.'-editor',
		)
	);
	register_block_type(
		'pgcsimplygalleryblock/grid', 
		array(
			'style'         => $slug.'-frontend',
			'editor_script' => $slug.'-js',
			'editor_style'  => $slug.'-editor',
		)
	);
}

add_action( 'init', 'simply_gallery_block_assets' );
add_action( 'wp_enqueue_scripts', 'pgc_sgb_frontend_scripts' );
add_action( 'the_post', 'pgc_sgb_frontend_scripts' );
