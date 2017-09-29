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

gatekeeper();

$pad_guid = elgg_extract('guid', $vars);
$pad = get_entity($pad_guid);

if (!elgg_instanceof($pad, 'object', 'etherpad') || !$pad->canEdit()) {
	register_error(elgg_echo('etherpad:unknown_pad'));
	forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('etherpad:edit');
elgg_push_breadcrumb($title);
// create form
$form_vars = array();
$body_vars = etherpad_prepare_form_vars($pad);
$content = elgg_view_form('etherpad/save', $form_vars, $body_vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
		));

echo elgg_view_page($title, $body);
