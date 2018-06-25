<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $relatedProductId    The Id to the related Product.
 * @property integer $relationType        The type of relation. Following values are allowed: 0=ContainsProduct 1=CrossSell 2=UpSell
 * @property integer $quantity            Optionally specify the quantity.
 * @property integer $sequence            The display Sequence.
 */
class ProductRelation extends Model
{

    public function getMap()
    {
        return [
            'relatedProductId' => 'RelatedProductId',
            'relationType'     => 'RelationType',
            'quantity'         => 'Quantity',
            'sequence'         => 'Sequence',
        ];
    }

    public function getRules()
    {
        return [
            ['relatedProductId', 'integer', true],
            ['relationType', 'integer', false],
            ['quantity', 'integer', true],
            ['sequence', 'integer', true],
        ];
    }

}