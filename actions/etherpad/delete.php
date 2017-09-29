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

$guid = get_input('guid');
$entity = get_entity($guid);

//if (($entity) && ($entity->canEdit())) {
if ($entity) {
	if ($entity->delete()) {
		system_message(elgg_echo('etherpad:delete:success', array($guid)));
	} else {
		register_error(elgg_echo('etherpad:delete:fail', array($guid)));
	}
} else {
	register_error(elgg_echo('etherpad:delete:fail', array($guid)));
}


forward(REFERER);
