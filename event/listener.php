<?php
/**
 *
 * @package phpBB Extension - Jmz Prefix
 * @copyright (c) 2016 Jmz Software
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace jmz\prefix\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup' => 'load_language_on_setup',
			'core.posting_modify_submission_errors' => 'force_prefix',
			'core.modify_posting_parameters' => 'show_prefixes'
		);
	}

	protected $config;

	protected $template;

	protected $user;

	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->config   = $config;
		$this->template = $template;
		$this->user	= $user;
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext          = $event['lang_set_ext'];
		$lang_set_ext[]        = array(
			'ext_name' => 'jmz/prefix',
			'lang_set' => 'common'
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	function forum_forced($id)
	{
		$array   = explode(', ', $this->config['forums_sel']);
		$forum_forced = false;
		foreach ($array as $value)
		{
			error_log($value);
			error_log("id: " . $id);
			if ($value == $id)
			{
				$forum_forced = true;
			}
		}
		return $forum_forced;
	}

	function force_prefix($event)
	{
		$forced = $this->forum_forced($event['forum_id']);
		$post_data_var = $event['post_data'];
		if ($forced)
		{
			if ($event['mode'] == 'post' || ($event['mode'] == 'edit' && $post_data_var['topic_first_post_id'] == $post_data_var['post_id']))
			{
				$prefix  = $this->config['prefixes_added'];
				$aPrefix = explode("\n", $prefix);
				$found  = false;
				foreach ($aPrefix as $sPrefix)
				{
					if (strpos($post_data_var['post_subject'], $sPrefix) === 0)
					{
						$found = true;
						break;
					}
				}
				if (!$found)
				{
					$error          = $event['error'];
					$error          = array($this->user->lang['PREFIX_ERROR']);
					$event['error'] = $error;
				}
			}
		}
	}

	function show_prefixes($event)
	{
		if ($this->config['prefix_enable'] && $this->forum_forced($event['forum_id']) && $event['mode'] != 'reply')
		{
			$prefixes    = $this->config['prefixes_added'];
			$prefixArray = explode("\n", $prefixes);
			$this->template->assign_vars(array(
				'S_PREFIX_FORUMS' => $prefixArray
			));
			for ($i = 0; $i < count($prefixArray); $i++)
			{
				$this->template->assign_block_vars('prefixes', array(
					'NAME' => $prefixArray[$i],
					'VALUE' => $prefixArray[$i]
				));
			}
			$this->template->assign_vars(array(
				'S_PREFIX_ENABLED' => true
			));
		}
		else
		{
			$this->template->assign_vars(array(
				'S_PREFIX_ENABLED' => false
			));
		}
	}
}
