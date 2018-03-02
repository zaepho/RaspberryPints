<?php

// The $steps array below contains the exact copy of the steps
// in our online demo at http://www.phpsetupwizard.com/demo
// We left it to help you understand how PHP Setup Wizard works
// Feel free to change it as necessary or simply clean it up and
// create your own $steps array to suit your needs. Enjoy!

$steps = array(

	// Step 1
	array(
		// Step name
		'name' => 'Select your language',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'To begin, please select the preferred language and click on "Next".',
			),

			// Language selection drop down box
			// PHP Setup wizard will automatically scan for available languages and display them
			array(
				'type' => 'language',
				'label' => 'Language',
				'name' => 'language',
			),
		),
	),
/*
	// Step 2
	array(
		// Step name
		'name' => 'License verification',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'Welcome to the "My Application" installation wizard.
				This automatic wizard will help you get the system up and running in just a couple of minutes.
				Please type in the license number for the software that you can find in the client area on our website.',
			),
			array(
				'type' => 'info',
				'value' => 'In this PHP Setup Wizard demo you may use the following license number: 1234-1234-1234-1234',
			),

			// Text box
			array(
				'type' => 'text',
				'label' => 'License number',
				'name' => 'license_number',
				'attributes' => array('class' => 'medium'),
				'default' => '',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
					array(
						'rule' => 'validate_license', // run "validate_license" function the "includes/validation.php" file upon form submission
						'error' => 'License number does not appear to be valid.'
					),
				),
			),
		),
	),
*/
	// Step 3
	array(
		// Step name
		'name' => 'Server requirements',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'Before proceeding with the full installation, we will carry out some tests on your server configuration to ensure that you are able to install and run our software.
				Please ensure you read through the results thoroughly and do not proceed until all the required tests are passed.',
			),

			// Simple text
			array(
				'type' => 'info',
				'value' => 'As part of this demonstration, create "cache" folder and an empty "config.php" file in the same directory where you have installed PHP Wizard Script.',
			),

			// Check PHP configuration
			array(
				'type' => 'php-config',
				'label' => 'Required PHP settings',
				'items' => array(
					'php_version' => array('>=7.1', 'PHP Version'), // PHP version must be at least 4.0
					'short_open_tag' => null, // Display the value for "short_open_tag" setting
					'register_globals' => false, // "register_globals" must be disabled
					'safe_mode' => false, // "safe_mode" must be disabled
					'upload_max_filesize' => '>=2mb', // "upload_max_filesize" must be at least 2mb
				),
			),

			// Check loaded PHP modules
			array(
				'type' => 'php-modules',
				'label' => 'Required PHP modules',
				'items' => array(
					'pdo' => array(true, 'PDO'), // make sure "mysql" module is loaded
					'pdo-mysql' => array(true, 'pdo_mysql')
				),
			),

			// Verify folder/file permissions
			array(
				'type' => 'file-permissions',
				'label' => 'Folders and files',
				'items' => array(
					'../includes/' => 'write', // make sure "cache" folder is writable
					'../templates_c/' => 'write', // make sure "config.php" file is writable
					'../img/' => 'write'
				),
			),
		),
	),
/*
	// Step 4
	array(
		// Step name
		'name' => 'Folder paths',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'We have automatically predefined the paths required by the system. Please make sure everything is correct before you continue on to the next step.',
			),
			array(
				'type' => 'info',
				'value' => 'In this PHP Setup Wizard demo you may use any random website and installation path values.',
			),

			// Text box
			array(
				'type' => 'text',
				'label' => 'Website URL',
				'name' => 'virtual_path',
				'default' => rtrim(preg_replace('#/install/$#', '', VIRTUAL_PATH), '/').'/', // set default value
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'type' => 'text',
				'label' => 'Installation path',
				'name' => 'system_path',
				'default' => rtrim(preg_replace('#/install/$#', '', BASE_PATH), '/').'/',
				'validate' => array(
					array('rule' => 'required'), // make it required
					array('rule' => 'validate_system_path'), // run "validate_system_path" function the "includes/validation.php" file upon form submission
				),
			),
		),
	),
*/
	// Step 5
	array(
		// Step name
		'name' => 'Database settings',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'Specify your database settings here. Please note that the database for our software must be created prior to this step. If you have not created one yet, do so now.',
			),
			array(
				'type' => 'info',
				'value' => 'In this PHP Setup Wizard demo you may use any random database values.',
			),

			// Text box
			array(
				'label' => 'Database hostname',
				'name' => 'db_hostname',
				'type' => 'text',
				'default' => 'localhost',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => 'Database username',
				'name' => 'db_username',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => 'Database password',
				'name' => 'db_password',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
				),
			),

			// Text box
			array(
				'label' => 'Database name',
				'name' => 'db_name',
				'type' => 'text',
				'default' => '',
				'highlight_on_error' => false,
				'validate' => array(
					array('rule' => 'required'), // make it "required"
					array(
						'rule' => 'database', // system will automatically verify database connection details based on the provided values
						'params' => array(
							'db_host' => 'db_hostname',
							'db_user' => 'db_username',
							'db_pass' => 'db_password',
							'db_name' => 'db_name'
						)
					),
				),
			),
		),
	),

	// Step 6
	array(
		// Step name
		'name' => 'Ready to install',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'We are now ready to proceed with installation. At this step we will attempt to create all required tables and populate them with data. Should something go wrong, go back to the Database Settings step and make sure everything is correct.',
			),
		),

		// Callback functions that will be executed
		'callbacks' => array(
			array('name' => 'install'), // run "install" function the "includes/callbacks.php" file upon successful form submission
		),
	),

	// Step 7
	array(
		// Step name
		'name' => 'Administrator account',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'Database tables have been successfully created and populated with data!',
			),
			array(
				'type' => 'info',
				'value' => 'You may now set up an administrator account for yourself. This will allow you to manage the website through the control panel.',
			),

			// Text box
			array(
				'label' => 'Username',
				'name' => 'user_username',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
					array('rule' => 'alpha_numeric'), // make sure email address is valid
					array('rule' => 'max_length', 'params' => 64),
				),
			),

			// Text box
			array(
				'label' => 'Email',
				'name' => 'user_email',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
					array('rule' => 'valid_email'), // make sure email address is valid
				),
			),

			// Text box
			array(
				'label' => 'Password',
				'name' => 'user_password',
				'type' => 'password',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
					array('rule' => 'alpha_numeric'), // make sure only alpha-numeric characters are provided
					array('rule' => 'min_length', 'params' => 5), // make sure password does not contain less than 5 characters
					array('rule' => 'max_length', 'params' => 64), // make sure password does not contain more than 20 characters
				),
			),

			// Text box
			array(
				'label' => 'Password (confirm)',
				'name' => 'user_password2',
				'type' => 'password',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'), // make it "required"
					array('rule' => 'matches', 'params' => 'user_password'), // make sure password text boxes match each other
				),
			),
		),

		// Callback functions that will be executed
		'callbacks' => array(
			array('name' => 'setup_admin'), // run "setup_admin" function the "includes/callbacks.php" file upon successful form submission
		),
	),

	// Step 8
	array(
		// Step name
		'name' => 'Completed',

		// Items we're going to display
		'fields' => array(

			// Simple text
			array(
				'type' => 'info',
				'value' => 'Administrator\'s account has been successfully created.',
			),
			array(
				'type' => 'info',
				'value' => 'Your website is available at <a href="'.rtrim(isset($_SESSION['params']['virtual_path']) ? $_SESSION['params']['virtual_path'] : '', '/').'" target="_blank">'.rtrim(isset($_SESSION['params']['virtual_path']) ? $_SESSION['params']['virtual_path'] : '', '/').'</a>'),
			array(
				'type' => 'info',
				'value' => 'You may login using these details:',
			),
			array(
				'type' => 'info',
				'value' => 'Email is '.(isset($_SESSION['params']['user_email']) ? $_SESSION['params']['user_email'] : '').'<br/>
				Password is '.(isset($_SESSION['params']['user_password']) ? $_SESSION['params']['user_password'] : ''),
			),
		),
	),
);
