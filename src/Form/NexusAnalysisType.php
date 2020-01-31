<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\StateGuide;
use App\Entity\Task;
use App\Entity\User\AppUser;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NexusAnalysisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("state", EntityType::class, [
                "class" => StateGuide::class,
                'placeholder' => 'Select State',
                'required' => false,
                "query_builder" => function (EntityRepository $er) use($options) {
                    return $er->createQueryBuilder("t")->where("t.account = 1");
                },
            ])
        ->add('startdate', ChoiceType::class, ['label' => 'Start Date', 'required' => false, 'choices' => $options['startdate'], 'placeholder' => 'Select Start Date', 'attr' => ['data-rule-required' => "false","class" => "startdate"]])
            ->add('enddate', ChoiceType::class, ['label' => 'End Date','required' => false, 'choices' => $options['enddate'] , 'placeholder' => 'Select End Date','attr' => ['data-rule-required' => "false","class" => "enddate"]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'account' => null,
            'startdate' => array(),
            'enddate' => array()
        ]);
    }
}
