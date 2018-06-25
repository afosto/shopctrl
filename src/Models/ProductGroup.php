<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\Operations\Find;
use Afosto\ShopCtrl\Components\Operations\FindAll;

/**
 * @property \DateTime              $changedTimestamp        Gets or sets the changed timestamp.
 * @property integer                $shopGroupId             Gets or sets the shop group identifier.
 * @property integer                $sequence                Gets or sets the sequence.
 * @property string                 $comment                 Gets or sets the comment.
 * @property boolean                $syncEnabled             Gets or sets a value indicating whether the synchronize is enabled.
 * @property boolean                $isActive                Gets or sets a value indicating whether this instance is active.
 * @property boolean                $includeInNavigation     Gets or sets a value indicating whether the navigation is included.
 * @property integer                $imageFileId             Gets or sets the image file identifier.
 * @property []    $children    Gets or sets the list of the children elements.
 * @property ProductGroupProperty[] $properties              Gets or sets the Product Group properties.
 * @property integer                $id                      Gets or sets the identifier.
 * @property string                 $name                    Gets or sets the name.
 * @property integer                $parentProductGroupId    Gets or sets the parent product group identifier.
 * @property integer                $nrOfChilds              The number of child Product Groups.
 */
class ProductGroup extends Model
{

    use Find, FindAll {
        find as parentFind;
    }

    /**
     * Used to cache during the request
     * @var array
     */
    private static $_cache = [];

    /**
     * Prevent lookup for every product within this request
     *
     * @param $id
     *
     * @return static
     */
    public function find($id)
    {
        if (!isset(self::$_cache[$id])) {
            self::$_cache[$id] = $this->parentFind($id);
        }

        return self::$_cache[$id];
    }

    /**
     * Returns the url to find all productGroups for a given shop group
     * @return string
     */
    public function findAllUri()
    {
        return '/v1/ShopGroups/' . App::getInstance()->getSetting('shopGroupId') . '/ProductGroups';
    }

    /**
     * Returns the root categories
     * @return static[]
     */
    public function findRoots()
    {
        return $this->findAll('/v1/ShopGroups/' . App::getInstance()->getSetting('shopGroupId') . '/RootProductGroups');
    }

    /**
     * @return array
     */
    public function getMap()
    {
        return [
            'changedTimestamp'     => 'ChangedTimestamp',
            'shopGroupId'          => 'ShopGroupId',
            'sequence'             => 'Sequence',
            'comment'              => 'Comment',
            'syncEnabled'          => 'SyncEnabled',
            'isActive'             => 'IsActive',
            'includeInNavigation'  => 'IncludeInNavigation',
            'imageFileId'          => 'ImageFileId',
            'children'             => 'Children',
            'properties'           => 'Properties',
            'id'                   => 'Id',
            'name'                 => 'Name',
            'parentProductGroupId' => 'ParentProductGroupId',
            'nrOfChilds'           => 'NrOfChilds',
        ];
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return [
            ['changedTimestamp', '\DateTime', false],
            ['shopGroupId', 'integer', false],
            ['sequence', 'integer', false],
            ['comment', 'string', false, 2147483647],
            ['syncEnabled', 'boolean', false],
            ['isActive', 'boolean', false],
            ['includeInNavigation', 'boolean', false],
            ['imageFileId', 'integer', false],
            ['children', '[]', false],
            ['properties', 'ProductGroupProperty[]', false],
            ['id', 'integer', true],
            ['name', 'string', false, 100],
            ['parentProductGroupId', 'integer', false],
            ['nrOfChilds', 'integer', false],
        ];
    }

}