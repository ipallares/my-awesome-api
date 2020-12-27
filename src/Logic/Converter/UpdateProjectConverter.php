<?php

namespace App\Logic\Converter;

use App\Entity\Project;
use App\Repository\ProjectRepository;

class UpdateProjectConverter
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
     * @param string|resource $data
     *
     * @return Project
     */
    public function __invoke($data): Project
    {
        $dataObject = json_decode($data);
        /** @var Project $project */
        $project = $this->repository->findWithCertainty(data_get($dataObject, 'id'));
        // IPT: TODO: Validate against a schema
        $project->setName(data_get($dataObject, 'name'));
        $project->setBudget(data_get($dataObject, 'budget'));

        return $project;
    }
}
