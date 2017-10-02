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

?>
<p>
	<?php
	echo elgg_echo('etherpad:base_url') . "<br>";

	echo elgg_view('input/text', array('name' => 'params[etherpad_url]', 'value' => $vars['entity']->etherpad_url));
	echo "&nbsp;" . elgg_echo('etherpad:example:url'). "<br>". "<br>";
	echo elgg_echo('etherpad:base_port') . "<br>";

	echo elgg_view('input/text', array('name' => 'params[etherpad_port]', 'value' => $vars['entity']->etherpad_port));
	echo "&nbsp;" . elgg_echo('etherpad:example:port');
	echo "<br>";
	?>

</p>
