<?php

$server = elgg_get_plugin_setting('etherpad', 'etherpad');
$url = elgg_extract('url', $vars);
$user = elgg_get_logged_in_user_entity();
$use_url = $server . '/p/' . $url;

echo '
    <iframe 
        name="embed_readwrite"
        src="' . $use_url . '?showControls=true&showChat=true&showLineNumbers=true&useMonospaceFont=false&userName=' . $user->username . '"
        width="100%" 
        height="900px">
    </iframe>';
