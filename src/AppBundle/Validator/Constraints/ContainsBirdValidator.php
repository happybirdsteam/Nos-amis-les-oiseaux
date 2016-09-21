<?php
namespace AppBundle\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsBirdValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em           = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        $containsBird = $this->em
            ->getRepository('AppBundle:NaoAves')
            ->findBy(array('lbNom' => $value));
        ;

        if(empty($containsBird)){
            $this->context->addViolation($constraint->message);
        }
    }
}