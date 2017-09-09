<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = -1;
//$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = ''; // IP of German office
$GLOBALS['TYPO3_CONF_VARS']['SYS']['enableDeprecationLog'] = 'file';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = 1;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = 'docker-typo3.stage';

$GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::WARNING] =
    [\TYPO3\CMS\Core\Log\Writer\PhpErrorLogWriter::class => []];
