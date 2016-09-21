<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsBird extends Constraint
{
    public $message = "Le musée est complet à la date choisi.";

    public function validatedBy()
    {
        //L'alias du service
        return get_class($this).'Validator';
    }
}