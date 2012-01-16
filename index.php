<?php


if ( ! file_exists('Core/Curse/config/database.php'))

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 */

define('Curse_DEVELOPMENT', 'development');
define('Curse_STAGING', 'staging');
define('Curse_PRODUCTION', 'production');

define('ENVIRONMENT', (isset($_SERVER['Curse_ENV']) ? $_SERVER['Curse_ENV'] : Curse_DEVELOPMENT));

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 */

	switch (ENVIRONMENT)
	{
		case Curse_DEVELOPMENT:
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
		break;

		case Curse_STAGING:
		case Curse_PRODUCTION:
			error_reporting(0);
		break;

		default:
			exit('The environment is not set correctly. ENVIRONMENT = '.ENVIRONMENT.'.');
	}
	
/*
|---------------------------------------------------------------
| DEFAULT INI SETTINGS
|---------------------------------------------------------------
*/

	// Let's hold Windows' hand and set a include_path in case it forgot
	set_include_path(dirname(__FILE__));

	// Some hosts (was it GoDaddy? complained without this
	@ini_set('cgi.fix_pathinfo', 0);
	
	// PHP 5.3 will BITCH without this
	if(ini_get('date.timezone') == '')
	{
		date_default_timezone_set('GMT');
	}


/*
|---------------------------------------------------------------
| Core FOLDER NAME
|---------------------------------------------------------------
*/
	$Core_path = 'Core/codeigniter';

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 */
	$application_folder = 'Core/Curse';

/*
 *---------------------------------------------------------------
 * ADDON FOLDER NAME
 *---------------------------------------------------------------
 */
	$addon_folder = 'addons';


// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------




/*
 * ---------------------------------------------------------------
 *  Resolve the Core path for increased reliability
 * ---------------------------------------------------------------
 */
	if (function_exists('realpath') AND @realpath($Core_path) !== FALSE)
	{
		$Core_path = realpath($Core_path).'/';
	}
	
	// ensure there's a trailing slash
	$Core_path = rtrim($Core_path, '/').'/';

	// Is the sytsem path correct?
	if ( ! is_dir($Core_path))
	{
		exit("Your Core folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */		
	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// The PHP file extension
	define('EXT', '.php');

 	// Path to the Core folder
	define('BASEPATH', str_replace("\\", "/", $Core_path));
	
	// The site slug: (example.com)
	define('SITE_DOMAIN', $_SERVER['HTTP_HOST']);

 	// This only allows you to change the name. ADDONPATH should still be used in the app
	define('ADDON_FOLDER', $addon_folder.'/');
	
	// The site ref. Used for building site specific paths
	define('SITE_REF', 'default');
					
	// Path to uploaded files for this site
	define('UPLOAD_PATH', 'uploads/'.SITE_REF.'/');
					
	// Path to the addon folder for this site
	define('ADDONPATH', ADDON_FOLDER.SITE_REF.'/');
	
	// Path to the addon folder that is shared between sites
	define('SHARED_ADDONPATH', 'addons/shared_addons/');
	
	// Path to the front controller (this file)
	define('FCPATH', str_replace(SELF, '', __FILE__));
	
	// Name of the "Core folder"
	$parts = explode('/', trim(BASEPATH, '/'));
	define('SYSDIR', end($parts));
	unset($parts);

	// The path to the "application" folder
	define('APPPATH', $application_folder.'/');
	
	// Path to the views folder
	define ('VIEWPATH', APPPATH.'views/' );


require_once BASEPATH.'core/CodeIgniter'.EXT;

?>
/* End of file index.php */
