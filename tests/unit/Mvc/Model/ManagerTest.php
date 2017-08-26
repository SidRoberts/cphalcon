<?php

namespace Phalcon\Test\Unit\Mvc\Model;

use Phalcon\Di;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Test\Models\Robots;
use Phalcon\Test\Module\UnitTest;
use Phalcon\Test\Models\Customers;
use Phalcon\Mvc\Model\MetaData\Memory;
use Phalcon\Test\Models\AlbumORama\Albums;

/**
 * \Phalcon\Test\Unit\Mvc\Model\ManagerTest
 * Tests the Phalcon\Mvc\Model\Manager component
 *
 * @copyright (c) 2011-2017 Phalcon Team
 * @link      https://www.phalconphp.com
 * @author    Andres Gutierrez <andres@phalconphp.com>
 * @author    Serghei Iakovlev <serghei@phalconphp.com>
 * @author    Wojciech Ślawski <jurigag@gmail.com>
 * @package   Phalcon\Test\Unit\Mvc\Model
 *
 * The contents of this file are subject to the New BSD License that is
 * bundled with this package in the file LICENSE.txt
 *
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email to license@phalconphp.com
 * so that we can send you a copy immediately.
 */
class ManagerTest extends UnitTest
{
    protected function setUpModelsManager()
    {
        $di = Di::getDefault();
        $db = $di->getShared('db');

        Di::reset();

        $di = new Di();
        $manager = new Manager();

        $di->setShared('db', $db);
        $di->setShared('modelsManager', $manager);
        $di->setShared('modelsMetadata', Memory::class);

        Di::setDefault($di);

        return $manager;
    }


    /**
     * Tests empty prefix for model
     *
     * @issue  10328
     * @author Sid Roberts <sid@sidroberts.co.uk>
     * @since  2017-04-15
     */
    public function testShoudReturSourceWithoutPrefix()
    {
        $this->specify(
            'Models manager does not return valid mapped source for a model',
            function () {
                $robots = new Robots();

                $modelsManager = $robots->getModelsManager();

                $robotsRepository = $modelsManager->getRepository(Robots::class);

                expect($modelsManager->getModelSource(Robots::class))->equals('robots');
                expect($robotsRepository->getSource())->equals('robots');
            }
        );
    }

    /**
     * Tests non-empty prefix for model
     *
     * @issue  10328
     * @author Sid Roberts <sid@sidroberts.co.uk>
     * @since  2017-04-15
     */
    public function testShoudReturSourceWithPrefix()
    {
        $this->specify(
            'Models manager does not return valid mapped source for a model',
            function () {
                $manager = new Manager();
                $manager->setModelPrefix('wp_');

                $robots = new Robots(null, $manager);


                expect($robots->getModelsManager()->getModelSource(Robots::class))->equals('wp_robots');
                expect($manager->getRepository(Robots::class)->getSource())->equals('wp_robots');
            }
        );
    }

    /**
     * Tests Manager::isVisibleModelProperty
     *
     * @author Serghei Iakovlev <serghei@phalconphp.com>
     * @since  2016-08-12
     */
    public function testModelPublicProperties()
    {
        $this->specify(
            'The Manager::isVisibleModelProperty does not check public property correctly',
            function ($property, $expected) {
                $modelsManager = $this->setUpModelsManager();

                expect($modelsManager->isVisibleModelProperty(new Customers, $property))->equals($expected);
            },
            [
                'examples' => [
                    ['id', true],
                    ['document_id', true],
                    ['customer_id', true],
                    ['first_name', true],
                    ['some_field', false],
                    ['', false],
                    ['protected_field', false],
                    ['private_field', false],
                ]
            ]
        );
    }
}
