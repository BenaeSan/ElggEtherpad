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

$urlpad = elgg_extract('url', $vars, '');
if (!$urlpad) {
    $urlpad = Pad::PadNameGenerator();
}
$objetive = elgg_extract('objetive', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);
$group_guid = elgg_get_page_owner_guid();
?>

<div>
    <label><?php echo elgg_echo("title"); ?></label><br />
    <?php
    echo elgg_view('input/text', array(
        'name' => 'title',
        'required' => TRUE,
        'disabled' => false));
    ?>
</div>
<div>
    <label><?php echo elgg_echo("etherpad:url"); ?></label><br />
    <?php
    echo elgg_view('input/text', array('name' => 'url',
        'value' => $urlpad,
        'disabled' => false));
    ?>
</div>

<div>
    <label><?php echo elgg_echo("etherpad:objective"); ?></label><br />
    <?php echo elgg_view('input/longtext', array('name' => 'objetive', 'value' => $objetive)); ?>
</div>
<div>
    <label><?php echo elgg_echo('access'); ?></label><br />
    <?php echo elgg_view('input/access', array('name' => 'access_id', 'value' => $access_id)); ?>
</div>


<?php
echo elgg_view('input/hidden', array('name' => 'group_guid', 'value' => $group_guid));
echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
if ($guid) {
    echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
}
?>

<div>
    <?php echo elgg_view('input/submit', array('value' => elgg_echo('save'))); ?>
</div>
