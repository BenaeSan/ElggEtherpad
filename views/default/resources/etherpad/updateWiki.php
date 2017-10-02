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
/*
 * Get the pad and extract content to update the wiki page
 */
$guid = elgg_extract('guid', $vars);

$pad = get_entity($guid);
$page = get_entity($pad->page_id);

$server = elgg_get_plugin_setting('etherpad_url', 'etherpad');
$port = elgg_get_plugin_setting('etherpad_port', 'etherpad');

if ($port) {
    $url = $server . ":" . $port . "/p/" . $pad->url . "/export/html";
} else {
    $url = $server . "/p/" . $pad->url . "/export/html";
}

$html = file_get_contents($url);

/*
 * TODO
 * CHORE retrieve content
 */
// cut just after bodyt
$html = explode ("<body>", $html);
// cut just before the last div
$html = explode ("<div", $html[1]);
// update page content
$page->annotate('page', $html[0], $page->access_id);

$page->save();

forward('pages/view/' . $page->guid);
