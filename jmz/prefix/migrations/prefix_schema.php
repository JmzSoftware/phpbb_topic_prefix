<?php
/**
*
* @package phpBB Extension - Jmz Prefix
* @copyright (c) 2016 Jmz Software
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace jmz\prefix\migrations;

class prefix_schema extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('prefix_enable', '')),
			array('config.add', array('prefix_version', '1.0.0-dev')),

		);
	}
}
