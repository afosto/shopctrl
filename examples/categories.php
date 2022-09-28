<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Cache\Adapter\Filesystem\FilesystemCachePool;

$filesystemAdapter = new Local(__DIR__ . '/');
$filesystem = new Filesystem($filesystemAdapter);
$cache = new FilesystemCachePool($filesystem);

use Afosto\ShopCtrl\Components\Settings;

$settings = new Settings();
$settings->baseUrl = "";
$settings->username = "";
$settings->password = "";
$settings->cultureId = "";
$settings->shopId = "";

\Afosto\ShopCtrl\Components\App::init($settings, $cache);
//Make sure these are set accordingly to the owner and group
\Afosto\ShopCtrl\Components\App::getInstance()->setSetting('shopOwnerId', 1);
\Afosto\ShopCtrl\Components\App::getInstance()->setSetting('shopGroupId', 1);

$structure = [];
foreach (\Afosto\ShopCtrl\Models\ProductGroup::model()->findAll() as $productGroup) {
    insertItem($structure, $productGroup);
}

/**
 * Helper function to recursively build the product group tree
 *
 * @param                                      $structure
 * @param \Afosto\ShopCtrl\Models\ProductGroup $group
 */
function insertItem(&$structure, \Afosto\ShopCtrl\Models\ProductGroup $group)
{
    if ($group->parentProductGroupId === null) {
        $structure['items'][$group->id]['group'] = $group;
    } else {
        if (!isset($structure['items'])) {
            $structure['items'] = [];
        } else {
            foreach ($structure['items'] as $id => &$item) {
                if ($id === $group->parentProductGroupId) {
                    $item['items'][$group->id]['group'] = $group;
                } else {
                    insertItem($item, $group);
                }
            }
        }
    }
}

//dump($structure);