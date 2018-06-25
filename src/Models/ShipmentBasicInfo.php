<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer          $id                   Gets or sets the identifier.
 * @property string           $shippingCode         Gets or sets the unique code for the shipment.
 * @property \DateTime        $createTimestamp      Gets or sets the create timestamp.
 * @property integer          $shopId               Gets or sets the Shop identifier.
 * @property integer          $orderId              Gets or sets the Order identifier.
 * @property string           $orderCode            Gets or sets the corresponding Order code.
 * @property integer          $warehouseId          Gets or sets the Warehouse identifier.
 * @property integer          $parcelId             The Id of the created parcel.
 * @property \DateTime        $pickedTimestamp      The time picked.
 * @property \DateTime        $packedTimestamp      The time packed.
 * @property \DateTime        $shippedTimestamp     The time shipped.
 * @property \DateTime        $handOverTimestamp    The time the Shipment was communicated to 3rd party fulfilment.
 * @property ShipmentTypeEnum $shipmentType         The type of Shipment.
 */
class ShipmentBasicInfo extends Model
{

    public function getMap()
    {
        return [
            'id'                => 'Id',
            'shippingCode'      => 'ShippingCode',
            'createTimestamp'   => 'CreateTimestamp',
            'shopId'            => 'ShopId',
            'orderId'           => 'OrderId',
            'orderCode'         => 'OrderCode',
            'warehouseId'       => 'WarehouseId',
            'parcelId'          => 'ParcelId',
            'pickedTimestamp'   => 'PickedTimestamp',
            'packedTimestamp'   => 'PackedTimestamp',
            'shippedTimestamp'  => 'ShippedTimestamp',
            'handOverTimestamp' => 'HandOverTimestamp',
            'shipmentType'      => 'ShipmentType',
        ];
    }

    public function getRules()
    {
        return [
            ['id', 'integer', false],
            ['shippingCode', 'string', false, 200],
            ['createTimestamp', '\DateTime', true],
            ['shopId', 'integer', false],
            ['orderId', 'integer', true],
            ['orderCode', 'string', false],
            ['warehouseId', 'integer', false],
            ['parcelId', 'integer', false],
            ['pickedTimestamp', '\DateTime', false],
            ['packedTimestamp', '\DateTime', false],
            ['shippedTimestamp', '\DateTime', false],
            ['handOverTimestamp', '\DateTime', false],
            ['shipmentType', 'ShipmentTypeEnum', false],
        ];
    }

}