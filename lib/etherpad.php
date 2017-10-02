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
/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $pad A pad object.
 * @return array
 */
function etherpad_prepare_form_vars($pad = null) {
    // input names => defaults
    $values = array(
        'title' => get_input('title', ''),
        'url' => get_input('url', ''),
        'objetive' => get_input('objetive', ''),
        'access_id' => ACCESS_DEFAULT,
        'container_guid' => elgg_get_page_owner_guid(),
        'guid' => null,
        'entity' => $pad,
    );

    if ($pad) {
        foreach (array_keys($values) as $field) {
            if (isset($pad->$field)) {
                $values[$field] = $pad->$field;
            }
        }
    }

    if (elgg_is_sticky_form('etherpad')) {
        $sticky_values = elgg_get_sticky_values('etherpad');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('etherpad');

    return $values;
}
