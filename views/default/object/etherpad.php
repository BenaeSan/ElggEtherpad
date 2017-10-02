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

$full = elgg_extract('full_view', $vars, FALSE);
$pad = elgg_extract('entity', $vars, FALSE);
$page_type = elgg_extract('page_type', $vars);

if (!$pad) {
    return TRUE;
}

$owner = $pad->getOwnerEntity();
$vars['owner_url'] = "etherpad/owner/$owner->username";

$metadata = '';
/* if (!elgg_in_context('widgets') && !elgg_in_context('gallery')) {
  // only show entity menu outside of widgets and gallery view
  $metadata = elgg_view_menu('entity', array(
  'entity' => $vars['entity'],
  'handler' => 'etherpad',
  'sort_by' => 'priority',
  //'class' => 'elgg-menu-hz',
  ));
  }// */

if ($full) {
    $params = array(
        'entity' => $pad,
        'metadata' => $metadata,
        'subtitle' => $subtitle,
        'content' => $pad->description,
    );
    //if on page wiki
    if ($page_type) {
        $url_update = "etherpad/updateWiki/$pad->guid";
        elgg_register_menu_item('title', array(
            'name' => 'etherpad',
            'href' => $url_update,
            'text' => elgg_echo('etherpad:edit:update:wiki'),
            'link_class' => 'elgg-button elgg-button-action',
        ));
    }

    $params = $params + $vars;

    $padFrame = elgg_view('output/etherpadframe', array(
        'url' => $pad->url,
    )); //*/

    $body = "$padFrame $output_link $extra";

    echo elgg_view('object/elements/full', array(
        'entity' => $pad,
        'body' => $body,
    )); //*/
} else {
    // brief view
    $excerpt = elgg_get_excerpt($pad->description);

    $params = array(
        'entity' => $pad,
        'metadata' => $metadata,
        'subtitle' => $subtitle,
        'content' => $excerpt,
    ); //*/
    $params = $params + $vars;
    echo elgg_view('object/elements/summary', $params);
}