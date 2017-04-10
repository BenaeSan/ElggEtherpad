<?php

elgg_register_event_handler('init', 'system', 'etherpad_init');

function etherpad_init() {
	elgg_register_library('elgg:etherpad', elgg_get_plugins_path() . 'etherpad/lib/etherpad.php');
	elgg_register_action("etherpad/save", elgg_get_plugins_path() . "etherpad/actions/etherpad/save.php");
	elgg_register_action("etherpad/delete", elgg_get_plugins_path() . "etherpad/actions/etherpad/delete.php");
	elgg_register_page_handler('etherpad', 'etherpad_page_handler');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'etherpad_owner_block_menu'); // Add menu in group menu
	//elgg_register_plugin_hook_handler('register', 'menu:entity', 'etherpad_entity_menu_setup');
	elgg_register_entity_type('object', 'etherpad');
	add_group_tool_option('etherpad', elgg_echo('group:pads'), true);
	elgg_extend_view('groups/tool_latest', 'etherpad/group_module');
}

function etherpad_page_handler($page) {
	elgg_load_library('elgg:etherpad');
	elgg_push_breadcrumb(elgg_echo('etherpad'), 'etherpad/all');
	elgg_push_context('etherpad');

	$page_type = elgg_extract(0, $page, 'all');
	$resource_vars = [
		'page_type' => $page_type,
	];



	switch ($page_type) {
		case 'all':
			//include elgg_get_plugins_path() . 'etherpad/pages/etherpad/all.php';
			echo elgg_view_resource('etherpad/all', $resource_vars);
			break;

		case 'owner':
			//include elgg_get_plugins_path() . 'etherpad/pages/etherpad/owner.php';
			echo elgg_view_resource('etherpad/owner', $resource_vars);
			break;

		case 'friends':
			//include elgg_get_plugins_path() . 'etherpad/pages/etherpad/friends.php';
			echo elgg_view_resource('etherpad/friends', $resource_vars);
			break;
		/* case 'read':
		  case 'view':
		  set_input('guid', $segments[1]);
		  include elgg_get_plugins_path() . 'etherpad/pages/etherpad/view.php';
		  break; // */
		case 'add':
			//include elgg_get_plugins_path() . 'etherpad/pages/etherpad/add.php';
			echo elgg_view_resource('etherpad/add', $resource_vars);
			break;
		case 'edit':
			set_input('guid', $page[1]);
			//include elgg_get_plugins_path() . 'etherpad/pages/etherpad/edit.php';
			echo elgg_view_resource('etherpad/edit', $resource_vars);
			break;
		case 'group':
			elgg_dump("-----GroupGuid-------");
			elgg_dump(elgg_extract(1, $page));
			elgg_dump("---------------------");

			$resource_vars['group_guid'] = elgg_extract(1, $page);
			//include elgg_get_plugins_path() . 'etherpad/pages/etherpad/owner.php';
			echo elgg_view_resource('etherpad/owner', $resource_vars);
			break;

		default:
			return false;
	}
	elgg_pop_context();
	return true;
}

/*
  function etherpad_owner_block_menu($hook, $type, $return, $params) { // Add menu if is active in group options
  if ($params['entity']->etherpad_enable != 'no') {
  //$url = "etherpad/group/{$params['entity']->guid}";
  $url = "etherpad/";
  $item = new ElggMenuItem('etherpad',elgg_echo('edocs'), $url);
  $return[] = $item;
  }
  return $return;
  }
 */

function etherpad_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$text = elgg_echo('etherpad');
		$url = "etherpad/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('etherpad', $text, $url);
		if (elgg_is_active_plugin('kalfukura')) {
			$item->setText(elgg_view_icon('list') . '  ' . $text);
		}
		$return[] = $item;
	} else {
		if ($params['entity']->etherpad_enable != 'no') {
			$text = elgg_echo('etherpad:group');
			$url = "etherpad/group/{$params['entity']->guid}/owner";
			$item = new ElggMenuItem('etherpad', $text, $url);
			if (elgg_is_active_plugin('kalfukura')) {
				$item->setText(elgg_view_icon('users') . '  ' . $text);
			}
			$return[] = $item;
		}
	}
	return $return;
}
