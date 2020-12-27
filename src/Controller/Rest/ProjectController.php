<?php

namespace App\Controller\Rest;

use App\Logic\Converter\CreateProjectConverter;
use App\Logic\Converter\UpdateProjectConverter;
use App\Repository\ProjectRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ProjectController extends AbstractFOSRestController
{

    /**
     * @var ProjectRepository
     */
    private $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Rest\Post("/api/1.0/project")
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createAction(CreateProjectConverter $converter, Request $request): View
    {
        $project = $converter($request->getContent());
        $this->repository->save($project);

        return View::create($project, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/api/1.0/project/{id}")
     */
    public function readAction(string $id): View {
        $project = $this->repository->find($id);

        return View::create($project, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/1.0/project")
     */
    public function listAction(Request $request): View {
        $project = $this->repository->findAll();

        return View::create($project, Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/api/1.0/project/{id}")
     */
    public function updateAction(UpdateProjectConverter $converter, Request $request): View
    {
        try {
            $project = $converter($request->getcontent());
            $this->repository->save($project);

            return View::create($project, Response::HTTP_OK);
        } catch (ResourceNotFoundException $e) {
            return View::create(null, Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return View::create(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Delete("/api/1.0/project/{id}")
     */
    public function deleteAction(string $id) {
        try {
            $project = $this->repository->findWithCertainty($id);
            $this->repository->remove($project);

            return View::create($project, Response::HTTP_OK);
        } catch (ResourceNotFoundException $e) {
            return View::create(null, Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return View::create(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
