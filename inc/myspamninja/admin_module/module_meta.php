<?php

if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

global $sub_menu;

function spamninja_meta()
{
	global $page, $lang, $plugins;

        $page->active_module = "spamninja";

	$sub_menu = array();
	$sub_menu['10'] = array("id" => "statistics", "title" => 'Statistics', "link" => "index.php?module=spamninja-index");
	$sub_menu['20'] = array("id" => "configuration", "title" => 'Configuration', "link" => "index.php?module=spamninja-configuration");
	$sub_menu['30'] = array("id" => "log", "title" => 'Log', "link" => "index.php?module=spamninja-log");
	
	$page->add_menu_item('My Spam Ninja', "spamninja", "index.php?module=spamninja", 80, $sub_menu);
	return true;
}

function spamninja_action_handler($action)
{
	global $page, $db, $lang, $plugins;
	
	$page->active_module = "spamninja";
	
	$actions = array(
		'index' => array('active' => 'statistics', 'file' => 'statistics.php'),
		'configuration' => array('active' => 'configuration', 'file' => 'configuration.php'),
		'log' => array('active' => 'log', 'file' => 'log.php')
	);
	
	if(isset($actions[$action]))
	{
		$page->active_action = $actions[$action]['active'];
		return $actions[$action]['file'];
	}
	else
	{
		$page->active_action = "statistics";
		return "statistics.php";
	}

}

?>