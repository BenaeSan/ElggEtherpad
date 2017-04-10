<?php

$guid = get_input('guid');

elgg_entity_gatekeeper($guid, 'object', 'etherpad');

$pad = get_entity($guid);

$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "etherpad/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "etherpad/owner/$page_owner->username");
}

$title = $pad->title;

elgg_push_breadcrumb($title);

$content = elgg_view_entity($pad, array('full_view' => true));
$content .= elgg_view_comments($pad);

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
	'header' => '',
		));

echo elgg_view_page($title, $body);