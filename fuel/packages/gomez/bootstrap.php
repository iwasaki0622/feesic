<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */


Autoloader::add_classes(array(
	'Gomez_Feeling'                => __DIR__.'/classes/feeling.php',
));

// Ensure the orm's config is loaded for Temporal
\Config::load('orm', true);
