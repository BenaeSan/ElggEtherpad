<?php

/**
 * View a single page
 * Override to link to etherpad
 * @package ElggPages
 */
$guid = elgg_extract('guid', $vars);

elgg_entity_gatekeeper($guid, 'object');

$page = get_entity($guid);
if (!pages_is_page($page)) {
    forward('', '404');
}

elgg_set_page_owner_guid($page->getContainerGUID());

elgg_group_gatekeeper();

$container = elgg_get_page_owner_entity();
if (!$container) {
    forward(REFERER);
}

$title = $page->title;

$content = elgg_view_entity($page, array('full_view' => true));
$content .= elgg_view_comments($page);

// can add subpage if can edit this page and write to container (such as a group)
if ($page->canEdit() && $container->canWriteToContainer(0, 'object', 'page')) {
    $url_subpage = "pages/add/$page->guid";
    elgg_register_menu_item('title', array(
        'name' => 'subpage',
        'href' => $url_subpage,
        'text' => elgg_echo('pages:newchild'),
        'link_class' => 'elgg-button elgg-button-action',
    ));

    $url_edit = "etherpad/addWiki/$page->guid";
    elgg_register_menu_item('title', array(
        'name' => 'etherpad',
        'href' => $url_edit,
        'text' => elgg_echo('etherpad:edit:with:etherpad'),
        'link_class' => 'elgg-button elgg-button-action',
    ));
}

$body = elgg_view_layout('content', array(
    'filter' => '',
    'content' => $content,
    'title' => $title,
    'sidebar' => elgg_view('pages/sidebar/navigation'),
        ));

echo elgg_view_page($title, $body);
