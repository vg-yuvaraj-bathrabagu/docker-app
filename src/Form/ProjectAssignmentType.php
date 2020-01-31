<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\ProjectAssignment;
use App\Entity\User\AppUser;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectAssignmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("project", EntityType::class, [
                "class" => Project::class,
                'placeholder' => 'Select Project',
                'required' => false,
                "query_builder" => function (EntityRepository $er) use($options) {
                    return $er->createQueryBuilder("t")->where("t.account = ".$options['account']." AND t.builtin = 0");
                }
            ]);
        $builder->add("user", EntityType::class, [
            "class" => AppUser::class,
            'placeholder' => 'Select User',
            'required' => false,
            "query_builder" => function (EntityRepository $er) use($options) {
                return $er->createQueryBuilder("t")->where("t.account = ".$options['account']);
            }
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjectAssignment::class,
            'account' => null,
        ]);
    }
}
