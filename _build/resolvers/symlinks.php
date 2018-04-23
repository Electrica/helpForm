<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/helpForm/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/helpform')) {
            $cache->deleteTree(
                $dev . 'assets/components/helpform/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/helpform/', $dev . 'assets/components/helpform');
        }
        if (!is_link($dev . 'core/components/helpform')) {
            $cache->deleteTree(
                $dev . 'core/components/helpform/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/helpform/', $dev . 'core/components/helpform');
        }
    }
}

return true;