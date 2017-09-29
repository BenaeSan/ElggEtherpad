<?php

/* * **************************************************************************
 * Copyright (C) 2017 Jade <http://www.jade.fr>
 * 
 * Benoit MOTTIN <benoit.mottin@jade.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************ */

$group = elgg_get_page_owner_entity();

if ($group->etherpad_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "etherpad/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
		));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'etherpad',
	'container_guid' => elgg_get_page_owner_guid(),
);
$content = elgg_list_entities($options);
elgg_pop_context();

$new_link = elgg_view('output/url', array(
	'href' => "etherpad/add/$group->guid",
	'text' => elgg_echo('etherpad:add'),
	'is_trusted' => true,
		));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('etherpad:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
