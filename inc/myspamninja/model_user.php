<?php

class SN_model_user{

    private $email;
    private $ip;
    private $username;

    private $emailcached = False;
    private $ipcached = False;
    private $usernamecached = False;


    /**
     * Sets the users email
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Sets the users IP address
     * @param String $ip 
     */
    public function setIP($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Sets the users username
     * @param String $username 
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Gets the email address of the user
     * @return String 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Gets the users username
     * @return String 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Gets the users IP address
     * @return String
     */
    public function getIP()
    {
        return $this->ip;
    }

    /**
     * Checks the user agains the various anti-spam validators available.
     * @return bool the outcome of the checks
     */
    public function checkUser()
    {
        
        global $mybb;

        if($mybb->settings['sn_usecache'] == True)
        {
            $this->_checkCache();
            if($this->checkResults($this->emailcached, $this->ipcached, $this->usernamecached))
            {
                //return True;
            }

        }

        $path = MYBB_ROOT .'inc/myspamninja/filter_modules/';

        if($handle = opendir($path))
        {


            while(false !== ($module = readdir($handle)))
            {

                $extension = substr($module, -3, 3);

                if(($module != '.') && ($module != '..') && ($extension == 'php'))
                {

                    include($path.$module);

                    $name = substr($module, 0, -4);

                    if(class_exists($name.'_filter')){
                        
                        $classname = $name.'_filter';

                        $filter = new $classname();
                        
                        $filter->runFilter($this);

                        $foundusername = $filter->usernameFound();

                        $foundip = $filter->ipFound();

                        $foundemail = $filter->emailFound();

                        if($this->checkResults($foundemail, $foundip, $foundusername))
                        {
                            return True;
                        }

                    }
                }

            }

            closedir($handle);
            
        }

    }

    /**
     * Logs the user
     */
    public function log()
    {
        
    }

    /*
     * Checks the cache to see if any of the users information is already
     * in the database. It sets the respective class attribute if it is found.
     */
    private function _checkCache()
    {

        global $mybb, $db;

        $query = $db->query('
            
            SELECT * FROM '. TABLE_PREFIX . 'spamninjacache
            WHERE value = \''.$this->username.'\' OR value = \''.$this->email.'\'
            OR value = \''.$this->ip.'\'

        ');

        while($result=$db->fetch_array($query))
        {
            switch($result['type']){
                case 'email':
                    $this->emailcached = True;
                    break;
                case 'ip':
                    $this->ipcached = True;
                    break;
                case 'username':
                    $this->usernamecached = True;
                    break;
            }
        }

    }

    /**
     * Takes three boolean arguments and sees if it is enough to trip the
     * spam check based on the users settings.
     * @param bool $email
     * @param bool $ip
     * @param bool $username 
     */
    private function checkResults($email, $ip, $username)
    {
        global $mybb;

        $email = $email && $mybb->settings['sn_checkip'];

        $ip = $ip && $mybb->settings['sn_checkemail'];

        $username = $username && $mybb->settings['sn_checkuser'];

        $count = $email + $ip + $username;

        if(($mybb->settings['sn_mode'] == 'all') && ($count == 3))
        {
            return True;
        }
        else if(($mybb->settings['sn_mode'] == 'majority') && ($count >= 2))
        {
            return True;
        }
        else if(($mybb->settings['sn_mode'] == 'one') && ($count >= 1))
        {
            return True;
        }
        else
        {
            return False;
        }
    }

}

?>
