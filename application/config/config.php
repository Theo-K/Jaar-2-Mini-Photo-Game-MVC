<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: URL
 * Here we auto-detect your applications URL and the potential sub-folder. Works perfectly on most servers and in local
 * development environments (like WAMP, MAMP, etc.). Don't touch this unless you know what you do.
 *
 * URL_PUBLIC_FOLDER:
 * The folder that is visible to public, users will only have access to that folder so nobody can have a look into
 * "/application" or other folder inside your application or call any other .php file than index.php inside "/public".
 *
 * URL_PROTOCOL:
 * The protocol. Don't change unless you know exactly what you do.
 *
 * URL_DOMAIN:
 * The domain. Don't change unless you know exactly what you do.
 *
 * URL_SUB_FOLDER:
 * The sub-folder. Leave it like it is, even if you don't use a sub-folder (then this will be just "/").
 *
 * URL:
 * The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
 * then replace this line with full URL (and sub-folder) and a trailing slash.
 */

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'mini');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');

/**
 * Configuration for: Cookies
 * 
 */
// 1209600 seconds = 2 weeks
define('COOKIE_RUNTIME', 1209600);
//IMPORTANT: always put a dot in front of the domain, like ".mydomain.com"
define('COOKIE_DOMAIN', '.localhost');

/**
 * Configuration for: HASHING
 * 
 */
define('HASH_COST_FACTOR', '10');

/**
 * Configuration for: Feedback messages
 * This is the place where you define your feed messages
 */
define('FEEDBACK_USERNAME_FIELD_EMPTY', 'FILL YO USERNAME IN GURL... UNF');
define('FEEDBACK_PASSWORD_FIELD_EMPTY', 'FILL YO PASSWORD IN GURL... UNF');
define('FEEDBACK_LOGIN_FAILED', 'FILL IN YO RIGHT STATS GURL... UNF');
define('FEEDBACK_PASSWORD_WRONG_3_TIMES', 'GUURL, YOU HAVE TYPED TOO MANY WRONG PASSWORDS YOU SILLY CHEESE STICK');
define('FEEDBACK_PASSWORD_REPEAT_WRONG', "NUH UH GURL. YO PASSWORDS DUN MATCH");
define('FEEDBACK_PASSWORD_TOO_SHORT', "GURL, EXTEND YO PASSWORD. YO PASSWORD NEEDS ATLEAST 6 CHARACTERS");
define('FEEDBACK_USERNAME_TOO_SHORT_OR_TOO_LONG', "OOH NO GURL, YOUR USERNAME CAN'T BE SHORTER THAN 2 OR LONGER THAN 64 CHARACTERS");
define('FEEDBACK_USERNAME_NOT_ALLOWED', "username does not fit the name scheme: only a-z and numbers allowed; 2 to 64 characters");
define('FEEDBACK_EMAIL_FIELD_EMPTY', 'FILL YO EMAIL IN GURL... UNF');
define('FEEDBACK_USERNAME_TOO_LONG', "OOH NO GURL, YOUR EMAIL CAN'T BE LONGER THAN 64 CHARACTERS");
define('FEEDBACK_EMAIL_NOT_VALID', "YOU THINK I'M CRAY CRAY? THAT IS NOT A REAL EMAIL");
define('FEEDBACK_UNKNOWN_ERROR', "SIR?? SIR??!!?! WHAT ARE YOU DOING");
define('FEEDBACK_USERNAME_ALREADY_TAKEN', "Username is already taken");
define('FEEDBACK_EMAIL_ALREADY_TAKEN', "Email is already taken");