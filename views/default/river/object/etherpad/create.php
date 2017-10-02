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
$user_id = elgg_get_logged_in_user_entity();
$object = $vars['item']->getObjectEntity();
$subject = $vars['item']->getSubjectEntity();
$group = get_group_entity_as_row($object->group_guid);

$pad_url = elgg_view('output/url', array(
    'href' => $object->url . "?userName=" . $user_id->name,
    'text' => $object->url,
    'target' => "_blank"
        ));

$excerpt = $object->excerpt ? $object->excerpt : $object->objetive;
$excerpt = elgg_get_excerpt($excerpt);

echo elgg_view('river/elements/layout', array(
    'item' => $vars['item'],
    'message' => $excerpt,
    'attachments' => $pad_url,
));
