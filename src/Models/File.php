<?php
namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer   $id                  Gets or sets the identifier.
 * @property string    $filename            Gets or sets the filename.
 * @property \DateTime $changedTimestamp    Gets the date/time on which the file was last changed
 * @property \DateTime $createdTimestamp    Gets the date/time on which the file was created
 * @property integer   $sequence            Gets or sets the sequence.
 * @property string    $base64Data          Gets or sets the base64 data.
 */
class File extends Model {
    public function getMap() {
        return [
            'id'               => 'Id',
            'filename'         => 'Filename',
            'changedTimestamp' => 'ChangedTimestamp',
            'createdTimestamp' => 'CreatedTimestamp',
            'sequence'         => 'Sequence',
            'base64Data'       => 'Base64Data',
        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', false],
            ['filename', 'string', false],
            ['changedTimestamp', '\DateTime', false],
            ['createdTimestamp', '\DateTime', false],
            ['sequence', 'integer', false],
            ['base64Data', 'string', false],
        ];
    }

}