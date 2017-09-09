<?php
$currentApplicationContext = \TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext();

//load server-specific configuration
$contextConfigFileName = strtolower(str_replace('/', '_', (string)$currentApplicationContext)).'.php';
$contextConfigFile = PATH_typo3conf . 'context/' . $contextConfigFileName;

$redisCacheOptions = [
    'database' => 2,
    'defaultLifetime' => 0,
    'hostname' => 'typo3-redis',
    'port' => 6379,
];

if (file_exists($contextConfigFile)) {
    require_once($contextConfigFile);
} else {
    throw new \RuntimeException(
        'Context-specific configuration missing for context ' . $currentApplicationContext . '. Please check your ApplicationContext and provide an appropriate configuration file.',
        1461913214
    );
}

if ($redisCacheOptions) {
    $cacheConfigurations = [
        'cache_hash',
        'cache_imagesizes',
        'cache_pages',
        'cache_pagesection',
        'cache_rootline',
        'extbase_datamapfactory_datamap',
        'extbase_object',
        'extbase_reflection'
    ];

    /*
     * Use Redis for Caching Framework BEGIN
     */
    // Make sure, that IndividualConfiguration contains $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_hash']['options']
    foreach ($cacheConfigurations as $cacheConfiguration) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$cacheConfiguration]['backend'] = \TYPO3\CMS\Core\Cache\Backend\RedisBackend::class;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$cacheConfiguration]['options'] =
            $redisCacheOptions + (array)$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$cacheConfiguration]['options'];
    }

    /*
     * unfortunately following cache configurations can't be overloaded in the array above,
     * because they are not yet initialized, when AdditionalConfiguration.php runs
     */

    // Cache configuration taken from ext_localconf.php of vhs 4.2.0 BEGIN
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['vhs_main'] = [
        'frontend' => \TYPO3\CMS\Core\Cache\Frontend\StringFrontend::class,
        'backend'  => \TYPO3\CMS\Core\Cache\Backend\RedisBackend::class,
        'options'  => $redisCacheOptions + ['defaultLifetime' => 804600],
        'groups'   => ['pages', 'all']
    ];

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['vhs_markdown'] = [
        'frontend' => \TYPO3\CMS\Core\Cache\Frontend\StringFrontend::class,
        'backend'  => \TYPO3\CMS\Core\Cache\Backend\RedisBackend::class,
        'options'  => $redisCacheOptions + ['defaultLifetime' => 804600],
        'groups'   => ['pages', 'all']
    ];
    // Cache configuration taken from ext_localconf.php of vhs 4.2.0 END
}