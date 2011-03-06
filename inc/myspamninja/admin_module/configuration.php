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

        $sub_tabs = array();

        if($page->active_action == 'configuration')
        {
            	$sub_tabs['registration'] = array(
			'title' => 'Registration',
			'link' => "index.php?module=spamninja-configuration&amp;tabaction=registration",
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
                $tabaction = 'registration';
            }

            $page->output_nav_tabs($sub_tabs, $tabaction);

            if($tabaction == 'other')
            {

                echo 'Other';

            }
            else if($tabaction == 'posting')
            {
                
                echo 'Posting';

            }
            else if($tabaction == 'crowdninja')
            {

                echo 'Crowd Ninja';

            }
            else if($tabaction == 'captcha')
            {

                echo 'CAPTCHA';
                
            }
            else if($tabaction == 'autoninja')
            {

                echo 'AutoNinja';
                
            }
            else
            {
                echo 'Registration';
            }

        }

	$page->output_footer();
}

?>