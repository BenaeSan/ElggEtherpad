<?php

elgg_register_event_handler('init', 'system', 'etherpad_init');

function etherpad_init() {
	elgg_register_library('elgg:etherpad', elgg_get_plugins_path() . 'etherpad/lib/etherpad.php');
	elgg_register_action("etherpad/save", elgg_get_plugins_path() . "etherpad/actions/etherpad/save.php");
	elgg_register_action("etherpad/delete", elgg_get_plugins_path() . "etherpad/actions/etherpad/delete.php");
	elgg_register_page_handler('etherpad', 'etherpad_page_handler');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'etherpad_owner_block_menu'); // Add menu in group menu
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
			echo elgg_view_resource('etherpad/all', $resource_vars);
			break;
		case 'owner':
			echo elgg_view_resource('etherpad/owner', $resource_vars);
			break;
		case 'friends':
			echo elgg_view_resource('etherpad/friends', $resource_vars);
			break;
		case 'add':
			echo elgg_view_resource('etherpad/add', $resource_vars);
			break;
		case 'edit':
			$resource_vars['guid'] = $page[1];
			echo elgg_view_resource('etherpad/edit', $resource_vars);
			break;
		case 'group':
			echo elgg_view_resource('etherpad/owner', $resource_vars);
			break;
		default:
			return false;
	}
	elgg_pop_context();
	return true;
}

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
			// kalfukura ??
			if (elgg_is_active_plugin('kalfukura')) {
				$item->setText(elgg_view_icon('users') . '  ' . $text);
			}
			$return[] = $item;
		}
	}
	return $return;
}
