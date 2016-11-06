<?php
/**
 *
 * @package phpBB Extension - Jmz Prefix
 * @copyright (c) 2016 Jmz Software
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace jmz\prefix\acp;

class prefix_info
{
	function module()
	{
		return array(
			'filename' => '\jmz\prefix\acp\prefix_module',
			'title' => 'ACP_PREFIX',
			'modes' => array(
				'config' => array(
					'title' => 'ACP_PREFIX_CONFIG',
					'auth' => 'ext_jmz/prefix && acl_a_board',
					'cat' => array(
						'ACP_PREFIX'
					)
				)
			)
		);
	}
}
