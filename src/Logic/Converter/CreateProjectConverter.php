<?php

namespace App\Logic\Converter;

use App\Entity\Project;
use Faker\Provider\Uuid;

class CreateProjectConverter
{
    // IPT: TODO: Use serializer for this

    /**
     * @param string|resource $data
     *
     * @return Project
     */
    public function __invoke($data): Project
    {
        $dataObject = json_decode($data);
        // IPT: TODO: Validate against a schema
        $project = new Project();
        $project->setName(data_get($dataObject, 'name'));
        $project->setBudget(data_get($dataObject, 'budget'));

        return $project;
    }
}
