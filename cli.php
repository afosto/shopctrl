#!/usr/bin/env php
<?php
/**
 * This file is used to generate models based on the live api documentation found at api.salesupply.com
 * Call it from the command line: $ php cli.php <uri> <modelPath> <tableNumber>
 *
 * Uri: the path of the documentation after /Help/
 * ModelPath: where to store the model file
 * TableNumber: number of the table on the docs page
 */
require __DIR__ . '/vendor/autoload.php';

use Afosto\ShopCtrl\Helpers\Generator\Scraper;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Scraper());

$application->run();