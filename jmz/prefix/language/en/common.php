<?php
/**
*
* @package phpBB Extension - Jmz Prefix
* @copyright (c) 2016 Jmz Software
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/


/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_PREFIX_CONFIG'		=> 'Jmz Prefix',
	'ACP_PREFIX_CONFIG_EXPLAIN'	=> 'This is configuration page for the Jmz Prefix extension.',
	'ACP_PREFIX_CONFIG_SET'		=> 'Configuration',
	'PREFIX_CONFIG_SAVED'		=> 'Jmz Prefix settings saved',
	'PREFIX_ENABLE'			=> 'Enable Jmz Prefix',
	'PREFIX_ENABLE_EXPLAIN'		=> 'Do you want to enable the Jmz Prefix EXT?',
	'PREFIX_ERROR'			=> 'A prefix must be selected.',
));
