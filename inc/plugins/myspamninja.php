<?php
 
// Disallow direct access to this file for security reasons
if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

require_once MYBB_ROOT .'inc/myspamninja/myspamninja.php';

require_once MYBB_ROOT .'inc/myspamninja/functions_install.php';


$plugins->add_hook("member_do_register_start", "SNMySpamNinja::checkRegistration");

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
	SNInstall::install();
}

function myspamninja_activate()
{
	SNInstall::activate();
}

function myspamninja_uninstall()
{
	SNInstall::uninstall();
}

function myspamninja_deactivate()
{
	SNInstall::deactivate();
}

function myspamninja_is_installed()
{
        return SNInstall::is_installed();
}


?>