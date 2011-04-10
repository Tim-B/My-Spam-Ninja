<?php
 
// Disallow direct access to this file for security reasons
if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

require_once MYBB_ROOT .'inc/myspamninja/myspamninja.php';

require_once MYBB_ROOT .'inc/myspamninja/functions_install.php';


$plugins->add_hook("member_do_register_start", "SNMySpamNinja::checkRegistration");

$plugins->add_hook("admin_tabs", "SNMySpamNinja::adminTabs");

$plugins->add_hook("admin_load", "SNMySpamNinja::adminLoad");

function myspamninja_info()
{
	return array(
		"name"			=> "My Spam Ninja",
		"description"	=> "A complete spam management solution for MyBB.",
		"website"		=> "https://github.com/Tim-B/My-Spam-Ninja",
		"author"		=> "Tim B.",
		"authorsite"	=> "https://github.com/Tim-B/My-Spam-Ninja",
		"version"		=> "1.0",
		"guid" 			=> "",
		"compatibility" => "*"
	);
}

function myspamninja_install()
{
    $install = new SNInstall;
    $install->install();
}

function myspamninja_activate()
{
    $install = new SNInstall;
    $install->activate();
}

function myspamninja_uninstall()
{
    $install = new SNInstall;
    $install->uninstall();
}

function myspamninja_deactivate()
{
    $install = new SNInstall;
    $install->deactivate();
}

function myspamninja_is_installed()
{
    return SNInstall::is_installed();
}


?>