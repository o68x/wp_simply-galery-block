<?php
/**
 * Plugin Name: SimpLy Gallery Block 
 * Plugin URI: https://blockslib.com/galleryblock/
 * Description: SimpLy Photo Gallery is a suite of beautiful gallery Gutenberg blocks with next gen Lightbox for photographers, artists, writers and content marketers. This plugin (Block set) will help you create responsive gallery images with a beautiful lightbox. Three desired layout in one plugin - Masonry, Justified and Grid.
 * Author: GalleryCreator
 * Author URI: https://blockslib.com/
 * Version: 1.1.4
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package SimpLy Gallery Block
 */

/**
 * Exit if accessed directly.
 */ 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'blocks/init.php';
