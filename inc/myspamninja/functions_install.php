<?php

class SNInstall{

    private $setting_insert = '';

    private $settingcount = 0;

    public function __construct()
    {
        $this->setting_insert .= 'INSERT INTO ' . TABLE_PREFIX . 'settings (';
        $this->setting_insert .= 'name, title, description, optionscode, value, disporder, gid, isdefault ) ';
        $this->setting_insert .= 'VALUES ';
    }

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
        
        $name = 'mode';
        $title = 'Filtering mode';
        $description = 'Should a user be rejected by the filter if they fail one, most or all of the checks on their details?';
        $optionscode = 'select all=All majority=Most one=One';
        $value = 2;
        $category = 'configuration';

        $this->_addSetting($name, $title, $description, $optionscode, $value, $category);

        $name = 'checkip';
        $title = 'Check users IP';
        $description = 'Check the users IP when filtering.';
        $optionscode = 'yesno';
        $value = 0;
        $category = 'configuration';

        $this->_addSetting($name, $title, $description, $optionscode, $value, $category);

        $name = 'checkemail';
        $title = 'Check users email address';
        $description = 'Check users email address when filtering.';
        $optionscode = 'yesno';
        $value = 0;
        $category = 'configuration';

        $this->_addSetting($name, $title, $description, $optionscode, $value, $category);

        $name = 'checkuser';
        $title = 'Check username';
        $description = 'Check users username when filtering.';
        $optionscode = 'yesno';
        $value = 0;
        $category = 'configuration';

        $this->_addSetting($name, $title, $description, $optionscode, $value, $category);

        $name = 'minip';
        $title = 'Minimum IP count';
        $description = 'What is the mimimum ammount of times an IP must have been reported to trip the filter?';
        $optionscode = 'text';
        $value = 1;
        $category = 'configuration';

        $this->_addSetting($name, $title, $description, $optionscode, $value, $category);

        $name = 'minemail';
        $title = 'Minimum email count';
        $description = 'What is the minimum number of times an email must have been reported to trip the filter?';
        $optionscode = 'text';
        $value = 1;
        $category = 'configuration';

        $this->_addSetting($name, $title, $description, $optionscode, $value, $category);

        $name = 'checkusername';
        $title = 'Minimum username count';
        $description = 'What is the minimum number of times a username must have been reported to trip the filter?';
        $optionscode = 'text';
        $value = 5;
        $category = 'configuration';

        $this->_addSetting($name, $title, $description, $optionscode, $value, $category);

        $name = 'log';
        $title = 'Log users?';
        $description = 'Log users who fail the filter?';
        $optionscode = 'yesno';
        $value = 0;
        $category = 'configuration';

        $this->_addSetting($name, $title, $description, $optionscode, $value, $category);

        $name = 'usecache';
        $title = 'Use cache when filtering?';
        $description = 'Use the cache to save API calls when filtering?';
        $optionscode = 'yesno';
        $value = 0;
        $category = 'configuration';

        $this->_addSetting($name, $title, $description, $optionscode, $value, $category);

        $this->setting_insert = substr($this->setting_insert, 0, -2);

        $this->setting_insert .= ';';

        $db->query($this->setting_insert);

        rebuild_settings();

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

        $db->delete_query("settings", "name LIKE 'SN_%'");

        rebuild_settings();
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

    private function _addSetting($name, $title, $description, $optionscode, $value, $category){


        $this->setting_insert .= '(';
        $this->setting_insert .= $this->prepValue('SN_'.$category.'_'.$name);
        $this->setting_insert .= $this->prepValue($title);
        $this->setting_insert .= $this->prepValue($description);
        $this->setting_insert .= $this->prepValue($optionscode);
        $this->setting_insert .= $this->prepValue($value);
        $this->settingcount++;
        $this->setting_insert .= $this->prepValue($this->settingcount);
        $this->setting_insert .= $this->prepValue(0);
        $this->setting_insert .= $this->prepValue(0, true);
        $this->setting_insert .= '), ';

    }

    private function prepValue($value, $last = false)
    {
        $return = '\'' . htmlspecialchars($value) . '\'';
        if(!$last)
        {
            $return .= ', ';
        }

        return $return;
    }
}
?>