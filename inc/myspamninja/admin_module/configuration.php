<?php

if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$page->add_breadcrumb_item('Configuration', "index.php?module=spamninja-configuration");


if(!$mybb->input['action'])
{
        global $page;

        $page->output_header('My Spam Ninja Configuration');

	echo 'Configuration';

	$page->output_footer();
}

?>