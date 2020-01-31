<?php

namespace App\Form;

use App\Entity\FileWatcher;
use App\Entity\Simulation;
use App\Entity\Template;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FileWatcherType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add("simulationid", EntityType::class, [
            "class" => Simulation::class,
            'required' => false,
            "query_builder" => function (EntityRepository $er) {
                return $er->createQueryBuilder("t");
            }
        ]);

        $builder->add("templateid", EntityType::class, [
            "class" => Template::class,
            'required' => false,
            "query_builder" => function (EntityRepository $er) {
                return $er->createQueryBuilder("t");
            }
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FileWatcher::class,
        ));
    }
}