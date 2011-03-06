<?php

if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$page->add_breadcrumb_item('Statistics', "index.php?module=spamninja-statistics");


if(!$mybb->input['action'])
{
        global $page, $sidebar, $sub_menu;

        $page->output_header('My Spam Ninja Statistics');

	echo 'Hello World';
	
	$page->output_footer();
}

?>