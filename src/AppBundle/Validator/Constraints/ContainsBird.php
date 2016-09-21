<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsBird extends Constraint
{
    public $message = "L'oiseau n'existe pas!";

    public function validatedBy()
    {
        //L'alias du service
        return get_class($this).'Validator';
    }
}