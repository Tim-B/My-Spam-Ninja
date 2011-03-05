<?php
	Class SNUser{
		
		public $username;
		
		public $email;
		
		public $ip;
		
		public function checkUser()
		{
		
                    global $mybb, $db;

                    //debug details:

                    //$this->username = 'lyclareCaglen';

                    //$this->email = 'uaukiibabalar@gmail.com';

                    //$this->ip = '91.201.67.43';
                    
                    if($this->_checkCache()){
                        $this->_failNinja();
                    }else if($this->_checkSFS()){
                        $this->_log();
                        $this->_failNinja();
                    }

		}

                private function _checkSFS()
                {
                    $url = 'http://www.stopforumspam.com/api?ip='. $this->ip .'&email='. $this->email .'&username=' . $this->username .'&f=json';

                    $data = file_get_contents($url);

                    $data = json_decode($data);
                    
                    if($data->ip->appears or $data->email->appears or $data->username->appears){
                        return True;
                    }else{
                        return False;
                    }
                }

                private function _checkCache()
                {
                    global $mybb, $db;

                    $query = $db->simple_select('spamninjalog', 'COUNT(*)', 'username = \''.$this->username.'\' OR email = \''.$this->email.'\' OR ip = \''.$this->ip.'\'');
                    
                    $count = $db->fetch_array($query);

                    if($count['COUNT(*)'] > 0){
                        return True;
                    }else{
                        return False;
                    }
                }
		
		private function _log()
		{
                    global $db;

                    $insert = array(
                        'ip' => $this->ip,
                        'email' => $this->ip,
                        'username' => $this->username
                    );
                    $db->insert_query('spamninjalog', $insert);
		}

                private function _failNinja()
                {
                    error('Your details match those of a known spammer, therefore you have been disallowed registration.');
                }
		
	}
?>