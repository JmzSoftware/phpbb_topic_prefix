<?php
/**
*
* @package phpBB Extension - Jmz Prefix
* @copyright (c) 2016 Jmz Software
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace jmz\prefix\migrations;

class prefix_module extends \phpbb\db\migration\migration
{

	public function update_data()
	{
		return array(
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_PREFIX')),
			array('module.add', array('acp', 'ACP_PREFIX',
			array('module_basename' => '\jmz\prefix\acp\prefix_module', 'modes' => array('config'),
			),
			)),
		);
	}
}
