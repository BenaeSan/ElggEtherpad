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

$guid = elgg_extract('guid', $vars);
$page = get_entity($guid);

if ($page->pad_id) {
    $urlpad = "etherpad/view/" . $page->pad_id;
} else {
    $pad = new Pad();
    $pad->name = $page->name;
    $pad->url = Pad::PadNameGenerator();
    $pad->page_id = $page->guid;
    $pad->save();
    $page->pad_id = $pad->guid;
    $page->save();
    $urlpad = "etherpad/view/" . $pad->guid;
}
$urlpad .= "/wiki";
forward($urlpad);
