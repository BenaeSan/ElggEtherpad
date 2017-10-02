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
elgg_register_event_handler('init', 'system', 'etherpad_init');

function etherpad_init() {
    // lib
    elgg_register_library('elgg:etherpad', elgg_get_plugins_path() . 'etherpad/lib/etherpad.php');
    // action
    elgg_register_action("etherpad/save", elgg_get_plugins_path() . "etherpad/actions/etherpad/save.php");
    elgg_register_action("etherpad/delete", elgg_get_plugins_path() . "etherpad/actions/etherpad/delete.php");

    elgg_register_page_handler('etherpad', 'etherpad_page_handler');
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'etherpad_owner_block_menu'); // Add menu in group menu
    // for research
    elgg_register_entity_type('object', 'etherpad');
    add_group_tool_option('etherpad', elgg_echo('group:pads'), true);
    elgg_extend_view('groups/tool_latest', 'etherpad/group_module');

    // hook
    elgg_register_plugin_hook_handler('entity:url', 'object', 'etherpad_set_url');
}

function etherpad_page_handler($page) {
    elgg_load_library('elgg:etherpad');
    //elgg_push_breadcrumb(elgg_echo('etherpad'), 'etherpad/all');
    //elgg_push_context('etherpad');

    $page_type = elgg_extract(0, $page, 'all');
    $resource_vars = [
        'page_type' => $page_type,
    ];

    switch ($page_type) {
        case 'all':
            echo elgg_view_resource('etherpad/all', $resource_vars);
            break;
        case 'view':
            $resource_vars['guid'] = $page[1];
            echo elgg_view_resource('etherpad/view', $resource_vars);
            break;
        case 'owner':
            echo elgg_view_resource('etherpad/owner', $resource_vars);
            break;
        case 'friends':
            echo elgg_view_resource('etherpad/friends', $resource_vars);
            break;
        case 'add':
            echo elgg_view_resource('etherpad/add', $resource_vars);
            break;
        // create a pad and link it to the page_wiki
        case 'addWiki':
            $resource_vars['guid'] = $page[1];
            echo elgg_view_resource('etherpad/addWiki', $resource_vars);
            break;
        case 'updateWiki':
            $resource_vars['guid'] = $page[1];
            echo elgg_view_resource('etherpad/updateWiki', $resource_vars);
            break;
        case 'edit':
            $resource_vars['guid'] = $page[1];
            echo elgg_view_resource('etherpad/edit', $resource_vars);
            break;
        case 'group':
            echo elgg_view_resource('etherpad/owner', $resource_vars);
            break;
        default:
            return false;
    }
    elgg_pop_context();
    return true;
}

function etherpad_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $text = elgg_echo('etherpad');
        $url = "etherpad/owner/{$params['entity']->username}";
        $item = new ElggMenuItem('etherpad', $text, $url);
        if (elgg_is_active_plugin('kalfukura')) {
            $item->setText(elgg_view_icon('list') . '  ' . $text);
        }
        $return[] = $item;
    } else {
        if ($params['entity']->etherpad_enable != 'no') {
            $text = elgg_echo('etherpad:group');
            $url = "etherpad/group/{$params['entity']->guid}/owner";
            $item = new ElggMenuItem('etherpad', $text, $url);
            // kalfukura ??
            if (elgg_is_active_plugin('kalfukura')) {
                $item->setText(elgg_view_icon('users') . '  ' . $text);
            }
            $return[] = $item;
        }
    }
    return $return;
}

function etherpad_set_url($hook, $type, $url, $params) {
    $entity = $params['entity'];
    if (elgg_instanceof($entity, 'object', 'etherpad')) {
        return "etherpad/view/{$entity->guid}";
    }
}
