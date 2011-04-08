<?php

    require_once MYBB_ROOT .'inc/myspamninja/filter_interface.php';

    class sfs_filter implements sn_filter
    {

        private $usernamefound = False;

        private $ipfound = False;

        private $emailfound = False;

        public function runFilter($user)
        {

            global $mybb;

            $url = 'http://www.stopforumspam.com/api?ip='. $user->getIP() 
                    .'&email='. $user->getEmail() .'&username='
                    . $user->getUsername() .'&f=json';

            $data = file_get_contents($url);

            $data = json_decode($data);

            if($data->ip->appears && ($data->ip->frequency >= $mybb->settings['sn_minip'])){

                $this->ipfound = True;

            }

            if($data->email->appears && ($data->email->frequency >= $mybb->settings['sn_minemail'])){

                $this->emailfound = True;

            }

            if($data->username->appears && ($data->username->frequency >= $mybb->settings['sn_minuser'])){

                $this->usernamefound = True;

            }
 

        }

        public function usernameFound()
        {
            return $this->usernamefound;
        }

        public function emailFound()
        {
            return $this->emailfound;
        }

        public function ipFound()
        {
            return $this->ipFound();
        }

        public function filterError()
        {
            
        }

    }

  
?>