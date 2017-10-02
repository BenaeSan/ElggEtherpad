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

$page_type = elgg_extract('page_type', $vars);
$guid = elgg_extract('guid', $vars);

elgg_entity_gatekeeper($guid, 'object', 'etherpad');
$pad = get_entity($guid);

//$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;

$params = [
    'filter' => '',
    'title' => $pad->title
];

if (elgg_instanceof($page_owner, 'group')) {
    elgg_push_breadcrumb($crumbs_title, "etherpad/group/$page_owner->guid/all");
} else {
    elgg_push_breadcrumb($crumbs_title, "etherpad/owner/$page_owner->username");
}//*/

elgg_push_breadcrumb($pad->title);

$params['content'] = elgg_view_entity($pad, array('full_view' => TRUE));

$body = elgg_view_layout('content', $params);

echo elgg_view_page($params[title], $body);
