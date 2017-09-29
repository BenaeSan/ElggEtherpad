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
 * GEt the pad and extract content to update the wiki page
 */
$guid = elgg_extract('guid', $vars);

$pad = get_entity($guid);




var_dump($pad);
var_dump($pad->page_id);
$page = get_entity($pad->page_id);


$url = elgg_get_plugin_setting('etherpad', 'etherpad') . $pad->url .  "/export/html";
$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

$html = curl_exec($c);

/*
 * TODO
 * CHORE retrieve content
 */
// cut just after bodyt
$html = split("<body>", $html);

// cut just before the last div
$html = split("<div", $html[1]);

$page->description = $html[0];

$page->save();

forward('pages/view/'.$page->guid);
