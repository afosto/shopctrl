<?php
namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $id                  The unique ShopCtrl Id field for the Resource.
 * @property integer $cultureId           Gets or sets the culture identifier.
 * @property integer $fileId              Gets or sets the File Id of the resource.
 * @property File    $file                MetaData information of file referred by The file data is not loaded in the object and must be retrieved separatly.
 * @property string  $name                Gets or sets the code.
 * @property string  $data                Gets or sets the Data.
 * @property integer $sequence            A Sequence number which can be used to determine ordering.
 * @property integer $resourceType        The type of resource. Following values are allowed: 0=File 1=Link 2=SharedFile
 * @property integer $contentType         The type of resource. Following values are allowed: 0=Generic 1=Image 2=Movie 3=Document
 * @property date    $changedTimestamp    A timestamp indicating the last save.
 * @property date    $createdTimestamp    The create timestamp.
 */
class ProductResource extends Model {

    public function getMap() {
        return [
            'id'               => 'Id',
            'cultureId'        => 'CultureId',
            'fileId'           => 'FileId',
            'file'             => 'File',
            'name'             => 'Name',
            'data'             => 'Data',
            'sequence'         => 'Sequence',
            'resourceType'     => 'ResourceType',
            'contentType'      => 'ContentType',
            'changedTimestamp' => 'ChangedTimestamp',
            'createdTimestamp' => 'CreatedTimestamp',
        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', true],
            ['cultureId', 'integer', false],
            ['fileId', 'integer', false],
            ['file', 'File', false],
            ['name', 'string', false, 255],
            ['data', 'string', false, 2147483647],
            ['sequence', 'integer', true],
            ['resourceType', 'integer', false],
            ['contentType', 'integer', false],
            ['changedTimestamp', '\DateTime', true],
            ['createdTimestamp', '\DateTime', true],
        ];
    }

}