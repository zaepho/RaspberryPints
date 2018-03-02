<?php

/**
* Callbacks class
*/
class Callbacks extends Callbacks_Core
{
	function install($params = array())
	{
		$dbconf = array(
			'db_host' => $_SESSION['params']['db_hostname'],
			'db_user' => $_SESSION['params']['db_username'],
			'db_pass' => $_SESSION['params']['db_password'],
			'db_name' => $_SESSION['params']['db_name'],
			'db_encoding' => 'utf8',
		);
		if ( !$this->db_init($dbconf) ) {
			return false;
		}

		$replace = array(
			'{:db_prefix}' => 'my_',
			'{:db_engine}' => in_array('innodb', $this->db_engines) ? 'InnoDB' : 'MyISAM',
			'{:db_charset}' => $this->db_version >= '4.1' ? 'DEFAULT CHARSET=utf8' : '',
			'{:website}' => $_SESSION['params']['virtual_path']
		);

		if ( !$this->db_import_file(BASE_PATH.'sql/data.sql', $replace) ) {
			return false;
		}

		// you can also manually run a query
		$this->db_query("INSERT INTO `my_table`(`name`,`val`) VALUES ('manual', 'Another value')", true);

		$this->db_close();

		$config_file = '<?php'."\n";;
		$config_file .= '// ------------------------------------------------------'."\n";
		$config_file .= '// DO NOT ALTER THIS FILE UNLESS YOU HAVE A REASON TO'."\n";
		$config_file .= '// ------------------------------------------------------'."\n";
		$config_file .= '$config[\'base_url\'] = \'' . $_SESSION['params']['virtual_path'] . '\';'."\n";
		$config_file .= '$config[\'license_key\'] = \'' . $_SESSION['params']['license_number'] . '\';'."\n\n";

		$config_file .= '$db[\'product\'][\'hostname\'] = \'' . addslashes($_SESSION['params']['db_hostname']) . '\';'."\n";
		$config_file .= '$db[\'product\'][\'username\'] = \'' . addslashes($_SESSION['params']['db_username']) . '\';'."\n";
		$config_file .= '$db[\'product\'][\'password\'] = \'' . addslashes($_SESSION['params']['db_password']) . '\';'."\n";
		$config_file .= '$db[\'product\'][\'database\'] = \'' . addslashes($_SESSION['params']['db_name']) . '\';'."\n";
		$config_file .= '?>';

		@file_put_contents(rtrim($_SESSION['params']['system_path'], '/').'/config.php', $config_file);

		return true;
	}

	function setup_admin($params = array())
	{
		$dbconf = array(
			'db_host' => $_SESSION['params']['db_hostname'],
			'db_user' => $_SESSION['params']['db_username'],
			'db_pass' => $_SESSION['params']['db_password'],
			'db_name' => $_SESSION['params']['db_name'],
			'db_encoding' => 'utf8',
		);
		if ( !($db = $this->db_init($dbconf)) ) {
			return false;
		}

		$salt = substr(sha1($_SESSION['params']['user_email'].time()), -8);

		$this->db_query("INSERT INTO my_table (name, val) VALUES('email', '".$this->db_escape($_SESSION['params']['user_email'])."')");
		$this->db_query("INSERT INTO my_table (name, val) VALUES('password', '".$this->db_escape($_SESSION['params']['user_password'])."')");

		$this->db_close();

		return true;
	}
}
