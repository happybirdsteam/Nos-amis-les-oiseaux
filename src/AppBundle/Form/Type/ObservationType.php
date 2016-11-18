<?php

namespace AppBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("lat", TextType::class, array(
                'label' => 'Latitude'
            ))
            ->add("lng", TextType::class, array(
                'label' => 'Longitude'
            ))
            ->add('comment', TextareaType::class, array(
                'label' => 'Commentaire',
                'required' => false
            ))
            ->add('date',  DateTimeType::class,
                array(
                    'label'=> 'Date d\'observation',
                    'date_widget' => "single_text", 'time_widget' => "single_text",
                    'data' => new \DateTime())
            )
            ->add('bird', TextType::class, array(
                'label' => 'Nom de l\'oiseau'

            ))
            ->add('image', FileType::class, array(
                'label' => 'Image',
                'required' => false
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Soumettre'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Observation'
        ));
    }
}
