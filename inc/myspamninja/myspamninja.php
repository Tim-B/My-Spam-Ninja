<?php

    require_once MYBB_ROOT .'inc/myspamninja/class_user.php';

    class SNMySpamNinja{

        public function checkRegistration()
	{
            global $mybb, $session;

            $user = New SNUser();

            $user->username = $mybb->input['username'];

            $user->email = $mybb->input['email'];

            $user->ip = $session->ipaddress;

            $user->checkUser();
	}
	
	public function squashSpam()
	{
	
	}

        public function adminTabs()
        {
            global $modules;

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