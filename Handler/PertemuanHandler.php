<?php

namespace Ais\PertemuanBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Ais\PertemuanBundle\Model\PertemuanInterface;
use Ais\PertemuanBundle\Form\PertemuanType;
use Ais\PertemuanBundle\Exception\InvalidFormException;

class PertemuanHandler implements PertemuanHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a Pertemuan.
     *
     * @param mixed $id
     *
     * @return PertemuanInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of Pertemuans.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Create a new Pertemuan.
     *
     * @param array $parameters
     *
     * @return PertemuanInterface
     */
    public function post(array $parameters)
    {
        $pertemuan = $this->createPertemuan();

        return $this->processForm($pertemuan, $parameters, 'POST');
    }

    /**
     * Edit a Pertemuan.
     *
     * @param PertemuanInterface $pertemuan
     * @param array         $parameters
     *
     * @return PertemuanInterface
     */
    public function put(PertemuanInterface $pertemuan, array $parameters)
    {
        return $this->processForm($pertemuan, $parameters, 'PUT');
    }

    /**
     * Partially update a Pertemuan.
     *
     * @param PertemuanInterface $pertemuan
     * @param array         $parameters
     *
     * @return PertemuanInterface
     */
    public function patch(PertemuanInterface $pertemuan, array $parameters)
    {
        return $this->processForm($pertemuan, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param PertemuanInterface $pertemuan
     * @param array         $parameters
     * @param String        $method
     *
     * @return PertemuanInterface
     *
     * @throws \Ais\PertemuanBundle\Exception\InvalidFormException
     */
    private function processForm(PertemuanInterface $pertemuan, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new PertemuanType(), $pertemuan, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $pertemuan = $form->getData();
            $this->om->persist($pertemuan);
            $this->om->flush($pertemuan);

            return $pertemuan;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createPertemuan()
    {
        return new $this->entityClass();
    }

}
