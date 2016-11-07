<?php
/**
*
* @package phpBB Extension - Jmz Prefix
* @copyright (c) 2016 Jmz Software
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
	if (empty($lang) || !is_array($lang))
	{
		$lang = array();
	}

$lang = array_merge($lang, array(
	'ACP_PREFIX'	=> 'Jmz Prefix',
	'PREFIX_CONFIG'	=> 'Jmz Prefix Settings',
));
