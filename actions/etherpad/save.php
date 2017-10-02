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
// get the form inputs

gatekeeper();
$user_guid = elgg_get_logged_in_user_guid();
$title = get_input('title');
$url = get_input('url');
$objetive = get_input('objetive');
$access_id = get_input('access_id');
$guid = get_input('guid');
$group_guid = get_input('group_guid');

$container_guid = get_input('container_guid', $user_guid);

elgg_make_sticky_form('etherpad');

if (!$url || !$objetive) {
    register_error(elgg_echo('etherpad:save:failed'));
    forward(REFERER);
}

if (!$guid) {
    // create a new etherpad object
    $pad = new Pad();    
    $new = true;
} else {
    $pad = get_entity($guid);
    $new = false;
}
// for now make all etherpad posts public

$pad->title = $title;
$pad->url = $url;
$pad->description = $objetive;
$pad->container_guid = (int) get_input('container_guid', $user_guid);
$pad->owner_guid = $user_guid;
$pad->group_guid = $group_guid;
$pad->access_id = $access_id;

// save to database and get id of the new etherpad
$pad_guid = $pad->save();

// if the etherpad was saved, we want to display the new post
// otherwise, we want to register an error and forward back to the form
if ($pad_guid) {
    elgg_clear_sticky_form('etherpad');
    system_message(elgg_echo('etherpad:save:success'));
    //add to river only if new

    if ($new) {
        elgg_create_river_item(array(
            'view' => 'river/object/etherpad/create',
            'action_type' => 'create',
            'subject_guid' => $user_guid,
            'object_guid' => $pad->getGUID(),
        ));
    }


    forward("etherpad/group/" . $group_guid . "/all");
} else {
    register_error(elgg_echo('etherpad:register:no:saved'));
    forward(REFERER); // REFERER is a global variable that defines the previous page
}
