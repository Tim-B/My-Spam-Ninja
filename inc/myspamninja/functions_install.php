<?php

class SNInstall{

    private $settings = array();

    public function install()
    {
        global $mybb, $db;

        $db->query('
            CREATE TABLE  ' . TABLE_PREFIX . 'spamninjalog (
            `log_id` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(80) NOT NULL,
            `email` varchar(80) NOT NULL,
            `ip` varchar(80) NOT NULL,
            `ipmatch` tinyint(1) NOT NULL,
            `emailmatch` tinyint(1) NOT NULL,
            `usermatch` tinyint(1) NOT NULL,
             PRIMARY KEY (`log_id`)
            ) ENGINE=MyISAM;');

        $db->query('
            CREATE TABLE  ' . TABLE_PREFIX . 'spamninjacache (
            `sn_id` int(11) NOT NULL AUTO_INCREMENT,
            `type` varchar(80) NOT NULL,
            `value` varchar(80) NOT NULL,
             PRIMARY KEY (`sn_id`)
            ) ENGINE=MyISAM;');

    }

    public function uninstall()
    {
        global $mybb, $db;
        if($db->table_exists("spamninjalog"))
	{
            $db->drop_table("spamninjalog");
	}

        if($db->table_exists("spamninjacache"))
	{
            $db->drop_table("spamninjacache");
	}
    }

    public function activate()
    {

    }

    public function deactivate()
    {
        
    }

    public function is_installed()
    {
	global $mybb, $db;

	return $db->table_exists("spamninjalog");
    }

    private function _addSetting($name, $title, $description){
        $settings[] = array(

        );
    }

}
?>