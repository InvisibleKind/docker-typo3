<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = true;
$GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = 0;
$GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = true;
$GLOBALS['TYPO3_CONF_VARS']['FE']['disableNoCacheParameter'] = false;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['cookieSecure'] = 2;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = 1;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '*';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['enableDeprecationLog'] = 'file';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['enable_DLOG'] = true;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['enable_errorDLOG'] = true;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['enable_exceptionDLOG'] = true;

//$GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'] =
//    E_WARNING | E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE | E_RECOVERABLE_ERROR | E_DEPRECATED | E_USER_DEPRECATED;
//// exceptionalErrors, syslogErrorReporting, belogErrorReporting can take parameters only from errorHandlerErrors,
//// so E_ALL in e.g. exceptionalErrors, means, that it covers everything from errorHandlerErrors, but not more than that
//// E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING can't be handled with custom error handler
//// E_NOTICE and E_STRICT raise much errors in core or fluidtypo3 extensions, so omitted as well
//$GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = E_ALL;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = E_WARNING | E_RECOVERABLE_ERROR | E_DEPRECATED | E_USER_DEPRECATED;
//$GLOBALS['TYPO3_CONF_VARS']['SYS']['syslogErrorReporting'] = E_ALL;
//$GLOBALS['TYPO3_CONF_VARS']['SYS']['belogErrorReporting'] = E_ALL;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = 'docker-typo3.dev.*';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = 1;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel'] = 0;

$GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::DEBUG] =
    [\TYPO3\CMS\Core\Log\Writer\PhpErrorLogWriter::class => []];

$GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'] = 'noreply@docker-typo3.dev';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport'] = 'smtp';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_server'] = 'mailtrap.io:2525';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_username'] = 'user';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_password'] = 'pass';

$customDevelopmentMappingFile = PATH_typo3conf . 'context/_development_custom.php';
file_exists($customDevelopmentMappingFile) && require_once($customDevelopmentMappingFile);

//$GLOBALS['TYPO3_CONF_VARS']['EXT']['runtimeActivatedPackages'] = ['phpunit', 'extension_builder'];