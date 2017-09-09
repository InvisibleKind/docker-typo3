<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = 'docker-typo3.live';

$GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::WARNING] =
    [\TYPO3\CMS\Core\Log\Writer\PhpErrorLogWriter::class => []];

// Maintenance mode ON
//$GLOBALS['TYPO3_CONF_VARS']['FE']['pageUnavailable_handling'] = '/fileadmin//Maintenance.html';
//$GLOBALS['TYPO3_CONF_VARS']['FE']['pageUnavailable_force'] = true;
//$GLOBALS['TYPO3_CONF_VARS']['BE']['adminOnly'] = 1;
//$GLOBALS['TYPO3_CONF_VARS']['BE']['loginSecurityLevel'] = 'normal';