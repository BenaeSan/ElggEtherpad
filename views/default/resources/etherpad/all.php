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

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('etherpad'));

elgg_register_title_button();

$offset = (int) get_input('offset', 0);
$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'etherpad',
	'limit' => 10,
	'offset' => $offset,
	'full_view' => false,
	'view_toggle_type' => false
		));
//*/


$title = elgg_echo('etherpad:everyone');

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('etherpad/sidebar'),
		));

echo elgg_view_page($title, $body);
