<?php
namespace NicoHerbig\TYPO3\CMS\Configuration\Cache;

use TYPO3\CMS\Core\Cache\Backend\ApcuBackend;
use TYPO3\CMS\Core\Cache\Backend\NullBackend;
use TYPO3\CMS\Core\Cache\Backend\TransientMemoryBackend;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 - 2017 Nico Herbig
 *  All rights reserved
 *
 * This file is part of the NicoHerbig.io TYPO3 CMS Configuration project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 3
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read
 * LICENSE file that was distributed with this source code.
 *
 ***************************************************************/

/**
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class CacheBackendUtility
{

    /**
     * This method checks if the PHP extension 'apcu' is installed and can be loaded.
     *
     * @return boolean
     */
    public static function isApcuCacheLoaded()
    {
        return extension_loaded('apcu');
    }

    /**
     * This method checks if the APCU-Cache is activated.
     *
     * @return boolean
     */
    public static function isApcuCacheEnabled()
    {
        return (boolean)ini_get('apc.enabled');
    }

    /**
     * @param string $cacheName
     */
    public static function setApcuCacheBackend($cacheName) {
        static::setCacheBackend($cacheName, ApcuBackend::class);
    }

    /**
     * @param string $cacheName
     */
    public static function setNullCacheBackend($cacheName) {
        static::setCacheBackend($cacheName, NullBackend::class);
    }

    /**
     * @param string $cacheName
     */
    public static function setTransientMemoryCacheBackend($cacheName) {
        static::setCacheBackend($cacheName, TransientMemoryBackend::class);
    }

    /**
     * @param string $cacheName
     * @param string $cacheBackendClassName
     * @param array $options
     */
    public static function setCacheBackend($cacheName, $cacheBackendClassName, $options = []) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$cacheName]['backend'] = $cacheBackendClassName;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$cacheName]['options'] = $options;
    }

}
