<?php

if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$page->add_breadcrumb_item('Log', "index.php?module=spamninja-log");


if(!$mybb->input['action'])
{
        global $page;

        $page->output_header('My Spam Ninja Log');

	echo 'Log';

	$page->output_footer();
}

?>