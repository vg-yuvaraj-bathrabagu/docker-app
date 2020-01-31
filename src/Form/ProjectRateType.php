<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\ProjectRate;
use App\Entity\User\AppUser;
use App\Helper\Utils;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectRateType extends AbstractType
{
    use Utils;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clientrate', NumberType::class, ['label' => 'Client Rate', 'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the regular rate", 'data-rule-number' => "true"]])
            ->add('contractorrate', NumberType::class, ['label' => 'Contractor Rate', 'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the contractor rate", 'data-rule-number' => "true"]])
            ->add('agencyrate', NumberType::class, ['label' => 'Agency Rate', 'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the agency rate", 'data-rule-number' => "true"]])
            ->add('overtimerate', NumberType::class, ['label' => 'Overtime Rate', 'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the overtime rate", 'data-rule-number' => "true"]])
            ->add('premiumrate', NumberType::class, ['label' => 'Premium Rate', 'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the premium rate", 'data-rule-number' => "true"]])
            ->add('doublerate', NumberType::class, ['label' => 'Double Rate', 'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the double rate", 'data-rule-number' => "true"]])
            ->add('triplerate', NumberType::class, ['label' => 'Triple Rate', 'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the triple rate", 'data-rule-number' => "true"]])
            ->add('dailyrate', NumberType::class, ['label' => 'Daily Rate', 'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the daily rate", 'data-rule-number' => "true"]])
            ->add('weeklyrate', NumberType::class, ['label' => 'Weekly Rate', 'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the weekly rate", 'data-rule-number' => "true"]])
            ->add('monthlyrate', NumberType::class, ['label' => 'Monthly Rate', 'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the monthly rate", 'data-rule-number' => "true"]])
            ->add('startdate', DateType::class, ['label' => 'Start Date','widget' => 'single_text','html5' => false,'attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the start date for the rate","class" => "datepicker" ]])
            ->add('enddate', DateType::class, ['label' => 'End Date','widget' => 'single_text','html5' => false, 'required' => false, 'attr' => ['data-rule-required' => "false","class" => "datepicker" ]])
            ->add('notes')
            ->add('uuid', HiddenType::class, ['data' => $this->getUuid()->toString()])
            ->add('id', HiddenType::class);

        $builder->add("user", EntityType::class, [
            "class" => AppUser::class,
            'placeholder' => 'Select User',
            'required' => false,
            "query_builder" => function (EntityRepository $er) use($options) {
                return $er->createQueryBuilder("t")->where("t.account = ".$options['account']);
            }
        ]);
        $builder->add("project", EntityType::class, [
            "class" => Project::class,
            'placeholder' => 'Select Project',
            'required' => false,
            "query_builder" => function (EntityRepository $er) use($options) {
                return $er->createQueryBuilder("t")->where("t.account = ".$options['account']);
            }
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjectRate::class,
            'account' => null,
        ]);
    }
}
