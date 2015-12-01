<?php

namespace Ais\PertemuanBundle\Tests\Fixtures\Entity;

use Ais\PertemuanBundle\Entity\Pertemuan;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadPertemuanData implements FixtureInterface
{
    static public $pertemuans = array();

    public function load(ObjectManager $manager)
    {
        $pertemuan = new Pertemuan();
        $pertemuan->setTitle('title');
        $pertemuan->setBody('body');

        $manager->persist($pertemuan);
        $manager->flush();

        self::$pertemuans[] = $pertemuan;
    }
}
