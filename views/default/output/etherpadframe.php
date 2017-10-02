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
 * show a etherpad instance into a iframe
 */
$server = elgg_get_plugin_setting('etherpad_url', 'etherpad');
$port = elgg_get_plugin_setting('etherpad_port', 'etherpad');
$url = elgg_extract('url', $vars);
$user = elgg_get_logged_in_user_entity();
if($port){
    $use_url = $server . ":" . $port . '/p/' . $url;    
}else{
    $use_url = $server . '/p/' . $url;
}

echo '
    <iframe 
        name="embed_readwrite"
        src="' . $use_url . '?showControls=true&showChat=true&showLineNumbers=true&useMonospaceFont=false&userName=' . $user->username . '"
        width="100%" 
        height="900px">
    </iframe>';
