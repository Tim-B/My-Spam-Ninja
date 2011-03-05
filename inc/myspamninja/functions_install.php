<?php

class SNInstall{

    public function install()
    {
        global $mybb, $db;

        $db->query('
            CREATE TABLE  ' . TABLE_PREFIX . 'spamninjalog (
            `log_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR( 80 ) NOT NULL ,
            `email` VARCHAR( 80 ) NOT NULL ,
            `ip` VARCHAR( 80 ) NOT NULL
            ) ENGINE = MYISAM ;');

    }

    public function uninstall()
    {
        global $mybb, $db;
        if($db->table_exists("spamninjalog"))
	{
            $db->drop_table("spamninjalog");
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

}
?>