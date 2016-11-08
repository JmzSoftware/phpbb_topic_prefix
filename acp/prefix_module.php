<?php
/**
*
* @package phpBB Extension - phpBB CDN
* @copyright (c) 2016 Jmz Software
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace jmz\prefix\acp;

class prefix_module
{
	var $u_action;

	function check_select($id, $forums_sel)
	{
		$selected = false;
		$forums_sel = explode(", ", $forums_sel);
		for ($j	= 0; $j	< count($forums_sel); $j++)
		{
			if ($forums_sel[$j] == $id)
			{
				$selected = true;
			}
		}
		return $selected;
	}

	function array_column_multi(array $input, array $column_keys)
	{
		$result = array();
		$column_keys = array_flip($column_keys);
		foreach ($input as $key => $el)
		{
			$result[$key] = array_intersect_key($el, $column_keys);
		}
		return $result;
	}

	function main()
	{
		global $user, $config, $request, $template;
		$this->tpl_name = 'acp_prefix_config';
		$this->page_title = $user->lang['PREFIX_CONFIG'];
		add_form_key('acp_prefix_config');
		$submit = $request->is_set_post('submit');

		if ($submit)
		{
			if (!check_form_key('acp_prefix_config'))
			{
				trigger_error('FORM_INVALID');
			}
			$config->set('prefix_enable', $request->variable('prefix_enable', 0));
			$config->set('prefixes_added', $request->variable('prefixes_added', ''));
			$config->set('forums_sel', implode(", ", $request->variable('forum_id', array(''), true)));
			trigger_error($user->lang['PREFIX_CONFIG_SAVED'] . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'PREFIX_VERSION'	=> (isset($config['prefix_version'])) ? $config['prefix_version'] : '',
			'PREFIX_ENABLE'		=> (!empty($config['prefix_enable'])) ? true : false,
			'PREFIXES_ADDED'	=> (isset($config['prefixes_added'])) ? $config['prefixes_added'] : '',
			'S_FORUM_OPTIONS'	=> make_forum_select(false, false, false, false, false, false),
			'FORUMS_SELECTED'	=> (isset($config['forums_sel'])) ? $config['forums_sel'] : '',
			'U_ACTION'		=> $this->u_action,
		));

		$forumArray = $this->array_column_multi(make_forum_select(false, false, false, false, false, false, true),
				array('forum_name', 'forum_id'));
		foreach ($forumArray as $item)
		{
			$template->assign_block_vars('selected', array(
				'NAME'		=> $item['forum_name'],
				'SELECTED'	=> $this->check_select($item['forum_name'], $config['forums_sel']),
			));
		}
	}
}
