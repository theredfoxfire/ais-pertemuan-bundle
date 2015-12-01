<?php

namespace Ais\PertemuanBundle\Tests\Handler;

use Ais\PertemuanBundle\Handler\PertemuanHandler;
use Ais\PertemuanBundle\Model\PertemuanInterface;
use Ais\PertemuanBundle\Entity\Pertemuan;

class PertemuanHandlerTest extends \PHPUnit_Framework_TestCase
{
    const DOSEN_CLASS = 'Ais\PertemuanBundle\Tests\Handler\DummyPertemuan';

    /** @var PertemuanHandler */
    protected $pertemuanHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::DOSEN_CLASS));
    }


    public function testGet()
    {
        $id = 1;
        $pertemuan = $this->getPertemuan();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($pertemuan));

        $this->pertemuanHandler = $this->createPertemuanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $this->pertemuanHandler->get($id);
    }

    public function testAll()
    {
        $offset = 1;
        $limit = 2;

        $pertemuans = $this->getPertemuans(2);
        $this->repository->expects($this->once())->method('findBy')
            ->with(array(), null, $limit, $offset)
            ->will($this->returnValue($pertemuans));

        $this->pertemuanHandler = $this->createPertemuanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $all = $this->pertemuanHandler->all($limit, $offset);

        $this->assertEquals($pertemuans, $all);
    }

    public function testPost()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $pertemuan = $this->getPertemuan();
        $pertemuan->setTitle($title);
        $pertemuan->setBody($body);

        $form = $this->getMock('Ais\PertemuanBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($pertemuan));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->pertemuanHandler = $this->createPertemuanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $pertemuanObject = $this->pertemuanHandler->post($parameters);

        $this->assertEquals($pertemuanObject, $pertemuan);
    }

    /**
     * @expectedException Ais\PertemuanBundle\Exception\InvalidFormException
     */
    public function testPostShouldRaiseException()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $pertemuan = $this->getPertemuan();
        $pertemuan->setTitle($title);
        $pertemuan->setBody($body);

        $form = $this->getMock('Ais\PertemuanBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->pertemuanHandler = $this->createPertemuanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $this->pertemuanHandler->post($parameters);
    }

    public function testPut()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $pertemuan = $this->getPertemuan();
        $pertemuan->setTitle($title);
        $pertemuan->setBody($body);

        $form = $this->getMock('Ais\PertemuanBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($pertemuan));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->pertemuanHandler = $this->createPertemuanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $pertemuanObject = $this->pertemuanHandler->put($pertemuan, $parameters);

        $this->assertEquals($pertemuanObject, $pertemuan);
    }

    public function testPatch()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('body' => $body);

        $pertemuan = $this->getPertemuan();
        $pertemuan->setTitle($title);
        $pertemuan->setBody($body);

        $form = $this->getMock('Ais\PertemuanBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($pertemuan));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->pertemuanHandler = $this->createPertemuanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $pertemuanObject = $this->pertemuanHandler->patch($pertemuan, $parameters);

        $this->assertEquals($pertemuanObject, $pertemuan);
    }


    protected function createPertemuanHandler($objectManager, $pertemuanClass, $formFactory)
    {
        return new PertemuanHandler($objectManager, $pertemuanClass, $formFactory);
    }

    protected function getPertemuan()
    {
        $pertemuanClass = static::DOSEN_CLASS;

        return new $pertemuanClass();
    }

    protected function getPertemuans($maxPertemuans = 5)
    {
        $pertemuans = array();
        for($i = 0; $i < $maxPertemuans; $i++) {
            $pertemuans[] = $this->getPertemuan();
        }

        return $pertemuans;
    }
}

class DummyPertemuan extends Pertemuan
{
}
