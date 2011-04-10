<?php

    require_once MYBB_ROOT .'inc/myspamninja/class_user.php';

    require_once MYBB_ROOT .'inc/myspamninja/model_user.php';

    class SNMySpamNinja{

        public function checkRegistration()
	{
            global $mybb, $session;

            $mybb->settings['sn_mode'] = 'majority';

            $mybb->settings['sn_checkip'] = True;

            $mybb->settings['sn_checkemail'] = True;

            $mybb->settings['sn_checkuser'] = True;

            $mybb->settings['sn_minuser'] = 2;

            $mybb->settings['sn_minip'] = 1;

            $mybb->settings['sn_minemail'] = 2;

            $mybb->settings['sn_log'] = True;

            $mybb->settings['sn_usecache'] = True;

            $user = New SN_model_user();

            //$user->setUsername($mybb->input['username']);

            $user->setUsername('Reyannethna');

            //$user->setEmail($mybb->input['email']);

            $user->setEmail('momvyra@yahoo.co.uk');

            $user->setIP($session->ipaddress);

            if(!$user->checkUser())
            {
                error('Your details match those of a known spammer');
            }
	}
	
	public function squashSpam()
	{
	
	}

        public function adminTabs()
        {
            global $modules, $page;

            require_once MYBB_ROOT ."inc/myspamninja/admin_module/module_meta.php";

            $has_permission = true;
            
            spamninja_meta();

            $modules['spamninja'] = 1;

        }

        public function adminLoad()
        {
            global $modules_dir, $run_module;

            if($run_module == 'spamninja'){

                $modules_dir .= '/../../inc/myspamninja';

                $run_module = 'admin_module';

            }

        }

    }
?>