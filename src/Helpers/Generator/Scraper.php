<?php

namespace Afosto\ShopCtrl\Helpers\Generator;

use Doctrine\Common\Inflector\Inflector;
use Symfony\Component\Console\Command\Command;
use GuzzleHttp\Client;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class Scraper extends Command
{

    const BASE = 'https://azalp.shopctrl.com:52222/Help/';

    /**
     * @var Client
     */
    private $_client;

    /**
     * Scraper constructor.
     *
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->_client = new Client(
            [
                'base_uri' => self::BASE,
            ]
        );
    }

    /**
     * Configure command
     */
    public function configure()
    {
        $this->setName('scrape')->setDescription('Scraper for model data');
        $this->addArgument('uri', InputArgument::REQUIRED, 'What is the uri?');
        $this->addArgument('path', InputArgument::REQUIRED, 'Target path?');
        $this->addArgument('tableNumber', InputArgument::OPTIONAL, 'Table number?', 1);
        $this->addArgument('requiredOnly', InputArgument::OPTIONAL, 'Required only?', false);
        parent::configure();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void;
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Scraping ' . self::BASE . $input->getArgument('uri'));
        $html = (string)$this->_client->get($input->getArgument('uri'))->getBody();
        $crawler = new Crawler($html);

        $output->writeln('Parsing');
        $table = $crawler->filter('table')->slice(($input->getArgument('tableNumber') - 1), 1);
        $params = $table->filter('tbody > tr')->each(
            function ($node)
            {
                return $this->parseNode($node);
            }
        );

        $this->writeFile($params, $input);
    }

    /**
     * @param Param[]        $params
     * @param InputInterface $input
     */
    protected function writeFile($params, InputInterface $input)
    {
        $contents[] = '<?php';

        $nameSpaceSuffix = substr($input->getArgument('path'), 0, strrpos($input->getArgument('path'), '/'));
        $contents[] = 'namespace Afosto\ShopCtrl\\' . $nameSpaceSuffix . ';';
        $contents[] = 'use Afosto\ShopCtrl\Components\Model;';
        $this->_getDocBlock($params, $input, $contents);
        $contents[] = 'class ' . basename($input->getArgument('path'), '.php') . ' extends Model {';
        $this->_getMap($params, $input, $contents);
        $this->_getRules($params, $input, $contents);
        $contents[] = '}';
        $path = dirname(__FILE__) . '/../../' . $input->getArgument('path');
        file_put_contents($path . '.php', implode("\n", $contents));
    }

    /**
     * @param $node
     *
     * @return Param
     */
    protected function parseNode($node)
    {
        $line = [];
        foreach ($node->filter('td') as $td) {
            $line[] = trim(preg_replace('/\s+/', ' ', $td->textContent));
        }
        $param = new Param($line);

        return $param;
    }

    /**
     * @param Param[]        $params
     * @param InputInterface $input
     * @param                $contents
     */
    private function _getRules($params, InputInterface $input, &$contents)
    {
        $contents[] = 'public function getRules() {';
        $contents[] = 'return [';
        foreach ($params as $param) {
            if ($input->getArgument('requiredOnly') && !$param->required) {
                continue;
            }
            $contents[] = "[" . $param->getLine() . "],";
        }

        $contents[] = '];';
        $contents[] = '}';
        $contents[] = null;
    }

    /**
     * @param                $params
     * @param InputInterface $input
     * @param                $contents
     */
    private function _getDocBlock($params, InputInterface $input, &$contents)
    {
        $contents[] = '/**';

        foreach ($params as $param) {
            $contents[] = '* @property ' . $param->type . "\t$" . Inflector::camelize(
                    $param->name
                ) . "\t" . $param->description;
        }

        $contents[] = '*/';
    }

    /**
     * @param Param[]        $params
     * @param InputInterface $input
     * @param                $contents
     *
     */
    private function _getMap($params, InputInterface $input, &$contents)
    {
        $contents[] = 'public function getMap() {';
        $contents[] = 'return [';
        foreach ($params as $param) {
            if ($input->getArgument('requiredOnly') && !$param->required) {
                continue;
            }

            $contents[] = "'" . Inflector::camelize($param->name) . "' => '" . $param->name . "',";
        }

        $contents[] = '];';
        $contents[] = '}';
        $contents[] = null;
    }
}