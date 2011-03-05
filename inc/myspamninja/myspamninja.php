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

    }
?>