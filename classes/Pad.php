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
 * Description of Pad
 *
 * @author Benoit MOTTIN <benoitmottin@jade.fr>
 */
class Pad extends ElggObject {

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes['subtype'] = "etherpad";
    }
    
    public static function PadNameGenerator() {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $random_string_length = 10;

        $stringpad = '';
        for ($i = 0; $i < $random_string_length; $i++) {
            $stringpad .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $stringpad;
    }

}
