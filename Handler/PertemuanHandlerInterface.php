<?php

namespace Ais\PertemuanBundle\Handler;

use Ais\PertemuanBundle\Model\PertemuanInterface;

interface PertemuanHandlerInterface
{
    /**
     * Get a Pertemuan given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return PertemuanInterface
     */
    public function get($id);

    /**
     * Get a list of Pertemuans.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0);

    /**
     * Post Pertemuan, creates a new Pertemuan.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return PertemuanInterface
     */
    public function post(array $parameters);

    /**
     * Edit a Pertemuan.
     *
     * @api
     *
     * @param PertemuanInterface   $pertemuan
     * @param array           $parameters
     *
     * @return PertemuanInterface
     */
    public function put(PertemuanInterface $pertemuan, array $parameters);

    /**
     * Partially update a Pertemuan.
     *
     * @api
     *
     * @param PertemuanInterface   $pertemuan
     * @param array           $parameters
     *
     * @return PertemuanInterface
     */
    public function patch(PertemuanInterface $pertemuan, array $parameters);
}
