<?php

namespace Afosto\ShopCtrl\Helpers\Generator;

use Doctrine\Common\Inflector\Inflector;

class Param
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $additionalInformation;

    /**
     * @var integer
     */
    public $maxLength;

    /**
     * @var bool
     */
    public $required = true;

    /**
     * Param constructor.
     *
     * @param $lineData
     */
    public function __construct($lineData)
    {
        [$this->name, $this->description, $this->type, $this->additionalInformation] = $lineData;
        $this->_validateType();
        $this->_validateAdditionalInformation();
    }

    /**
     * @return string
     */
    public function getLine()
    {
        $name = Inflector::camelize($this->name);
        $required = ($this->required) ? 'true' : 'false';
        $line = rtrim("'$name', '$this->type', $required, $this->maxLength", ', ');

        return $line;
    }

    /**
     * Validator for type
     */
    private function _validateType()
    {
        switch ($this->type) {
            case 'integer':
            case 'string':
            case 'boolean':
                break;
            case 'date':
                $this->type = '\DateTime';
                break;
            case 'decimal number':
                $this->type = 'float';
                break;
            default:
                $this->_formatType();
                break;
        }
    }

    /**
     * Validate the other table data
     */
    private function _validateAdditionalInformation()
    {
        if (strpos($this->additionalInformation, 'Required') !== false) {
            $this->required = true;
        } else {
            $this->required = false;
        }

        if (strpos($this->additionalInformation, 'Max length') !== false) {
            $this->maxLength = (int)filter_var($this->additionalInformation, FILTER_SANITIZE_NUMBER_INT);
        } else {
            $this->maxLength = null;
        }
    }

    /**
     * Format the type
     */
    private function _formatType()
    {
        if (strpos($this->type, 'Collection of') !== false) {
            preg_match('/Collection of (.*)/', $this->type, $match);
            if ($match[1] != 'integer') {
                $this->type = $match[1] . '[]';
            } else {
                $this->type = '[]';
            }
        }
    }

}