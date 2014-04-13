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


function decode_callback($matches) {
    $char = mb_convert_encoding($matches[1], "UTF-16", "UTF-8");
    $escaped = "";
    for ($i = 0, $l = strlen($char); $i < $l; $i += 2) {
        $escaped .=  "\u" . sprintf("%02x%02x", ord($char[$i]), ord($char[$i+1]));
    }
    return $escaped;
}
