<?php

if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$page->add_breadcrumb_item('Configuration', "index.php?module=spamninja-configuration");

require_once MYBB_ROOT .'inc/myspamninja/configuration_class.php';

if(!$mybb->input['action'])
{
        global $page;

        $page->output_header('My Spam Ninja Configuration');

        $sub_tabs = array();

        if($page->active_action == 'configuration')
        {
            	$sub_tabs['configuration'] = array(
			'title' => 'General configuration',
			'link' => "index.php?module=spamninja-configuration&amp;tabaction=configuration",
			'description' => 'Edit options relating to how Spam Ninja filters new registrations.'
		);

		$sub_tabs['captcha'] = array(
			'title' => 'CAPTCHA',
			'link' => "index.php?module=spamninja-configuration&amp;tabaction=captcha",
			'description' => 'Edit options to what CAPTCHA method Spam Ninja uses.'
		);

               $sub_tabs['autoninja'] = array(
			'title' => 'AutoNinja',
			'link' => "index.php?module=spamninja-configuration&amp;tabaction=autoninja",
			'description' => 'Edit options for AutoNinja spam tools.'
		);

               $sub_tabs['crowdninja'] = array(
			'title' => 'CrowdNinja',
			'link' => "index.php?module=spamninja-configuration&amp;tabaction=crowdninja",
			'description' => 'Edit options related to the CrowdNinja tools.'
		);


                $sub_tabs['posting'] = array(
			'title' => 'Posting',
			'link' => "index.php?module=spamninja-configuration&amp;tabaction=posting",
			'description' => 'Control how Spam Ninja handles posts.'
		);

                $sub_tabs['other'] = array(
			'title' => 'Other Options',
			'link' => "index.php?module=spamninja-configuration&amp;tabaction=other",
			'description' => 'Other options for Spam Ninja.'
		);


        

            if(isset($mybb->input['tabaction'])){
                $tabaction = $mybb->input['tabaction'];
            }else{
                $tabaction = 'configuration';
            }

            $page->output_nav_tabs($sub_tabs, $tabaction);



            if(file_exists(MYBB_ROOT .'inc/myspamninja/admin_module/configuration/'.$tabaction.'.php'))
            {
                include('configuration/'.$tabaction.'.php');
                
                $SNclassname = 'configuration_' . $tabaction . '_class';

                $SNsettings = new $SNclassname;

                if($mybb->input['task'] == 'save')
                {
                    $SNsettings->saveSettings($mybb->input);
                }

                $SNsettings->editSettings();
                
            }else{
                echo '/configuration/'.$tabaction.'.php';
            }

        }

	$page->output_footer();
}

?>