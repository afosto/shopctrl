<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Components\Operations\Find;
use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;

/**
 * @property integer           $shopGroupId                  Gets or sets the shop group identifier.
 * @property string            $eAN                          Gets or sets the European Article Number.
 * @property string            $note                         Gets or sets the note.
 * @property string            $refCode                      An optional reference for the Product.
 * @property ProductBrand      $productBrand                 Optionally contains Brand information for the Product.
 * @property boolean           $customerMustAskForPrice      Gets or sets a value indicating whether the customer should not see the price, but must explicitly ask for it.
 * @property integer           $productVariantParentId       The Id to the ProductVariant parent. The Type of the product should be ProductVariant (2) when used.
 * @property string            $variantInfo                  This field contains a summary of the values of the Variation properties. This field is only used when the Type = ProductVariant (2). Eg: 'Black | XL'
 * @property \DateTime         $creationDate                 Gets the creation date.
 * @property integer           $mainImageFileId              Gets or sets the main image file identifier.
 * @property \DateTime         $mainImageChangedTimestamp    Gets the changed timestamp of the Main Image.
 * @property boolean           $keepStock                    Gets or sets a value indicating whether [keep stock].
 * @property float             $minimumStock                 Gets or sets the minimum stock.
 * @property float             $qtyAvailable                 Gets or sets the qty available.
 * @property float             $qtyOnHand                    Gets or sets the qty on hand.
 * @property float             $qtyReserved                  Gets or sets the qty reserved.
 * @property boolean           $syncEnabled                  Gets or sets a value indicating whether [synchronize enabled].
 * @property boolean           $published                    Gets or sets a value indicating whether this is published.
 * @property float             $weight                       Gets or sets the weight.
 * @property integer           $weightUOMId                  Gets or sets the weight uom identifier.
 * @property float             $height                       Gets or sets the height.
 * @property integer           $sizeUOMId                    Gets or sets the Size (used for length/height/width/diameter) uom identifier.
 * @property float             $length                       Gets or sets the length.
 * @property float             $width                        Gets or sets the width.
 * @property float             $diameter                     Gets or sets the Diameter.
 * @property integer           $volumeUOMId                  Gets or sets the Volume uom identifier.
 * @property float             $volume                       Gets or sets the Volume.
 * @property float             $priceExVat                   Gets or sets the price ex vat.
 * @property integer           $productPropertyDefSetId      Gets or sets the product property definition set identifier.
 * @property integer           $transportCategoryId          The Transport Category assigned to the Product.
 * @property []                $productGroups                Gets or sets the product groups.
 * @property ProductResource[] $resources                    Gets a list of all Product Resources. Resources can be additional images, documents, etc.
 * @property ProductRelation[] $productRelations             Gets a list of all Product Relations. Relations can exist for cross-sell, up-sell, etc.
 * @property ProductProperty[] $properties                   A collection of translatable Product Properties. Following property codes are system properties which can be used: "Name", "Description", "Published", "DescriptionLong", "MetaTitle", "MetaKeywords", "MetaDescription", "NameTemplate", "DescriptionTemplate", "DescriptionLongTemplate"
 * @property []                $productVariantPropertyDefIds This collection holds the Id's of ProductPropertyDefinitions which are used to create Product Variants for. This collection is only used when the Product is of the Type ProductVariantParent.
 * @property []                $productVariantIds            This collection holds the Id's of the (child) Product Variants. This collection is only used when the Product is of the Type ProductVariantParent.
 * @property string            $hscode                       Gets or sets the Harmonized System Code.
 * @property integer           $originCountryId              Gets or sets the Country of Origin.
 * @property string            $originCountryCode            Gets or sets the country code (ISO2) for the Country of Origin.
 * @property integer           $id                           Gets or sets the identifier.
 * @property string            $code                         Gets or sets the code.
 * @property string            $name                         Gets or sets the name.
 * @property integer           $type                         The ProductType, available: SimpleProduct = 0, ProductVariantParent = 1, ProductVariant = 2
 * @property \DateTime         $changedTimestamp             Gets the changed timestamp.
 */
class Product extends Model {

    use Find;

    /**
     * Returns the property value for the given cultureId and code
     *
     * @param      $code
     * @param null $cultureId
     *
     * @return null|string
     */
    public function getPropertyForCulture($code, $cultureId = null) {
        foreach ($this->properties as $property) {
            if ($property->cultureId == $cultureId && $property->code == $code) {
                return $property->value;
            }
        }
        if ($cultureId !== null) {
            return $this->getPropertyForCulture($code, null);
        }

        return null;
    }

    public function getMap() {
        return [
            'shopGroupId'                  => 'ShopGroupId',
            'eAN'                          => 'EAN',
            'note'                         => 'Note',
            'refCode'                      => 'RefCode',
            'productBrand'                 => 'ProductBrand',
            'customerMustAskForPrice'      => 'CustomerMustAskForPrice',
            'productVariantParentId'       => 'ProductVariantParentId',
            'variantInfo'                  => 'VariantInfo',
            'creationDate'                 => 'CreationDate',
            'mainImageFileId'              => 'MainImageFileId',
            'mainImageChangedTimestamp'    => 'MainImageChangedTimestamp',
            'keepStock'                    => 'KeepStock',
            'minimumStock'                 => 'MinimumStock',
            'qtyAvailable'                 => 'QtyAvailable',
            'qtyOnHand'                    => 'QtyOnHand',
            'qtyReserved'                  => 'QtyReserved',
            'syncEnabled'                  => 'SyncEnabled',
            'published'                    => 'Published',
            'weight'                       => 'Weight',
            'weightUOMId'                  => 'WeightUOMId',
            'height'                       => 'Height',
            'sizeUOMId'                    => 'SizeUOMId',
            'length'                       => 'Length',
            'width'                        => 'Width',
            'diameter'                     => 'Diameter',
            'volumeUOMId'                  => 'VolumeUOMId',
            'volume'                       => 'Volume',
            'priceExVat'                   => 'PriceExVat',
            'productPropertyDefSetId'      => 'ProductPropertyDefSetId',
            'transportCategoryId'          => 'TransportCategoryId',
            'productGroups'                => 'ProductGroups',
            'resources'                    => 'Resources',
            'productRelations'             => 'ProductRelations',
            'properties'                   => 'Properties',
            'productVariantPropertyDefIds' => 'ProductVariantPropertyDefIds',
            'productVariantIds'            => 'ProductVariantIds',
            'hscode'                       => 'Hscode',
            'originCountryId'              => 'OriginCountryId',
            'originCountryCode'            => 'OriginCountryCode',
            'id'                           => 'Id',
            'code'                         => 'Code',
            'name'                         => 'Name',
            'type'                         => 'Type',
            'changedTimestamp'             => 'ChangedTimestamp',
        ];
    }

    public function getRules() {
        return [
            ['shopGroupId', 'integer', true],
            ['eAN', 'string', false],
            ['note', 'string', false, 2147483647],
            ['refCode', 'string', false, 500],
            ['productBrand', 'ProductBrand', false],
            ['customerMustAskForPrice', 'boolean', true],
            ['productVariantParentId', 'integer', false],
            ['variantInfo', 'string', false, 100],
            ['creationDate', '\DateTime', true],
            ['mainImageFileId', 'integer', false],
            ['mainImageChangedTimestamp', '\DateTime', false],
            ['keepStock', 'boolean', true],
            ['minimumStock', 'float', true],
            ['qtyAvailable', 'float', true],
            ['qtyOnHand', 'float', true],
            ['qtyReserved', 'float', true],
            ['syncEnabled', 'boolean', true],
            ['published', 'boolean', true],
            ['weight', 'float', false],
            ['weightUOMId', 'integer', false],
            ['height', 'float', false],
            ['sizeUOMId', 'integer', false],
            ['length', 'float', false],
            ['width', 'float', false],
            ['diameter', 'float', false],
            ['volumeUOMId', 'integer', false],
            ['volume', 'float', false],
            ['priceExVat', 'float', true],
            ['productPropertyDefSetId', 'integer', false],
            ['transportCategoryId', 'integer', false],
            ['productGroups', '[]', false],
            ['resources', 'ProductResource[]', false],
            ['productRelations', 'ProductRelation[]', false],
            ['properties', 'ProductProperty[]', false],
            ['productVariantPropertyDefIds', '[]', false],
            ['productVariantIds', '[]', false],
            ['hscode', 'string', false, 20],
            ['originCountryId', 'integer', false],
            ['originCountryCode', 'string', false],
            ['id', 'integer', true],
            ['code', 'string', true, 100],
            ['name', 'string', false, 400],
            ['type', 'integer', false],
            ['changedTimestamp', '\DateTime', false],
        ];
    }

    /**
     * @param string $code the product sku
     *
     * @return static
     * @throws ApiException
     */
    public function findByCode($code) {
        return $this->find(null, 'v1/ShopGroup/' . App::getInstance()
                                                      ->getSetting('shopId') . '/Products/' . $code);
    }
}