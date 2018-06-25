<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\Operations\Find;

/**
 * @property integer   $id                  Gets or sets the identifier.
 * @property string    $filename            Gets or sets the filename.
 * @property \DateTime $changedTimestamp    Gets the date/time on which the file was last changed
 * @property \DateTime $createdTimestamp    Gets the date/time on which the file was created
 * @property integer   $sequence            Gets or sets the sequence.
 * @property string    $base64Data          Gets or sets the base64 data.
 * @property string    $checksum            Gets or sets the checksum data.
 */
class File extends Model
{

    use Find;

    public function getMap()
    {
        return [
            'id'               => 'Id',
            'filename'         => 'Filename',
            'changedTimestamp' => 'ChangedTimestamp',
            'createdTimestamp' => 'CreatedTimestamp',
            'sequence'         => 'Sequence',
            'base64Data'       => 'Base64Data',
            'checksum'         => 'Checksum',
        ];
    }

    public function getRules()
    {
        return [
            ['id', 'integer', false],
            ['filename', 'string', false],
            ['changedTimestamp', '\DateTime', false],
            ['createdTimestamp', '\DateTime', false],
            ['sequence', 'integer', false],
            ['base64Data', 'string', false],
            ['checksum', 'string', false],
        ];
    }

    /**
     * Returns true in case download was complete
     *
     * @return bool
     */
    public function isComplete()
    {
        return $this->checksum == sha1(base64_decode($this->base64Data));
    }

}