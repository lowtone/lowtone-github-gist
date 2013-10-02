<?php
/*
 * Plugin Name: GitHub: Gist
 * Plugin URI: http://wordpress.lowtone.nl/github-gist
 * Description: Embed a code snippet from a Github gist.
 * Version: 1.0
 * Author: Lowtone <info@lowtone.nl>
 * Author URI: http://lowtone.nl
 * License: http://wordpress.lowtone.nl/license
 */
/**
 * @author Paul van der Meijs <code@lowtone.nl>
 * @copyright Copyright (c) 2013, Paul van der Meijs
 * @license http://wordpress.lowtone.nl/license/
 * @version 1.0
 * @package wordpress\Packages\lowtone\github\gist
 */

namespace lowtone\github\gist {

	use lowtone\content\packages\Package;

	// Includes
	
	if (!include_once WP_PLUGIN_DIR . "/lowtone-content/lowtone-content.php") 
		return trigger_error("Lowtone Content Package is required", E_USER_ERROR) && false;

	Package::init(array(
			Package::INIT_SUCCESS => function() {

				// Register embed handler

				wp_embed_register_handler("github_gist", "#^https?://gist.github.com/[^/]+/[^/]+(\.js)?$#i", function($matches, $attr, $url, $rawattr) {
					$url = $matches[0];

					if (".js" != strtolower(substr($url, -3)))
						$url .= ".js";

					return sprintf('<script src="%s"></script>', esc_url($url));
				});

			}
		));

}