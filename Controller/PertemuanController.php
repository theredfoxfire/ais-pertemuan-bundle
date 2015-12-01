<?php

namespace Ais\PertemuanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Ais\PertemuanBundle\Exception\InvalidFormException;
use Ais\PertemuanBundle\Form\PertemuanType;
use Ais\PertemuanBundle\Model\PertemuanInterface;


class PertemuanController extends FOSRestController
{
    /**
     * List all pertemuans.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing pertemuans.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many pertemuans to return.")
     *
     * @Annotations\View(
     *  templateVar="pertemuans"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getPertemuansAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->container->get('ais_pertemuan.pertemuan.handler')->all($limit, $offset);
    }

    /**
     * Get single Pertemuan.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Pertemuan for a given id",
     *   output = "Ais\PertemuanBundle\Entity\Pertemuan",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the pertemuan is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="pertemuan")
     *
     * @param int     $id      the pertemuan id
     *
     * @return array
     *
     * @throws NotFoundHttpException when pertemuan not exist
     */
    public function getPertemuanAction($id)
    {
        $pertemuan = $this->getOr404($id);

        return $pertemuan;
    }

    /**
     * Presents the form to use to create a new pertemuan.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newPertemuanAction()
    {
        return $this->createForm(new PertemuanType());
    }
    
    /**
     * Presents the form to use to edit pertemuan.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisPertemuanBundle:Pertemuan:editPertemuan.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the pertemuan id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when pertemuan not exist
     */
    public function editPertemuanAction($id)
    {
		$pertemuan = $this->getPertemuanAction($id);
		
        return array('form' => $this->createForm(new PertemuanType(), $pertemuan), 'pertemuan' => $pertemuan);
    }

    /**
     * Create a Pertemuan from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new pertemuan from the submitted data.",
     *   input = "Ais\PertemuanBundle\Form\PertemuanType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisPertemuanBundle:Pertemuan:newPertemuan.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postPertemuanAction(Request $request)
    {
        try {
            $newPertemuan = $this->container->get('ais_pertemuan.pertemuan.handler')->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newPertemuan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_pertemuan', $routeOptions, Codes::HTTP_CREATED);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing pertemuan from the submitted data or create a new pertemuan at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\PertemuanBundle\Form\PertemuanType",
     *   statusCodes = {
     *     201 = "Returned when the Pertemuan is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisPertemuanBundle:Pertemuan:editPertemuan.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the pertemuan id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when pertemuan not exist
     */
    public function putPertemuanAction(Request $request, $id)
    {
        try {
            if (!($pertemuan = $this->container->get('ais_pertemuan.pertemuan.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $pertemuan = $this->container->get('ais_pertemuan.pertemuan.handler')->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $pertemuan = $this->container->get('ais_pertemuan.pertemuan.handler')->put(
                    $pertemuan,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $pertemuan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_pertemuan', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing pertemuan from the submitted data or create a new pertemuan at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\PertemuanBundle\Form\PertemuanType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisPertemuanBundle:Pertemuan:editPertemuan.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the pertemuan id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when pertemuan not exist
     */
    public function patchPertemuanAction(Request $request, $id)
    {
        try {
            $pertemuan = $this->container->get('ais_pertemuan.pertemuan.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $pertemuan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_pertemuan', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Fetch a Pertemuan or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return PertemuanInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($pertemuan = $this->container->get('ais_pertemuan.pertemuan.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $pertemuan;
    }
    
    public function postUpdatePertemuanAction(Request $request, $id)
    {
		try {
            $pertemuan = $this->container->get('ais_pertemuan.pertemuan.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $pertemuan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_pertemuan', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
	}
}
