<?php

if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$page->add_breadcrumb_item('Configuration', "index.php?module=msn-log");


if(!$mybb->input['action'])
{
	
	echo 'Hello World';
	
	$page->output_footer();
}

?>