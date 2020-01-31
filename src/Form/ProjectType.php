<?php

namespace App\Form;

use App\Entity\Project;
use App\Helper\Utils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{

    use Utils;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('effectivedate', DateType::class, ['label' => 'Effective Date','widget' => 'single_text','html5' => false, 'empty_data' => '', 'required' => false, 'attr' => ['data-rule-required' => "false","class" => "datepicker" ]])
            ->add('budget')
            ->add('expirydate', DateType::class, ['label' => 'Expiry Date','widget' => 'single_text','html5' => false, 'empty_data' => '', 'required' => false, 'attr' => ['data-rule-required' => "false","class" => "datepicker" ]])
            ->add('projectid')
            ->add('title')
            ->add('projectcategory')
            ->add('sponsor')
            ->add('projectexecutive')
            ->add('projectmanager')
            ->add('jobcode')
            ->add('costcentercode')
            ->add('activity')
            ->add('laborpoline')
            ->add('travelpoline')
            ->add('odcpoline')
            ->add('mailinglist')
            ->add('priority')
            ->add('estimatedstartdate', DateType::class, ['label' => 'Estimated Start Date','widget' => 'single_text','html5' => false, 'empty_data' => '', 'required' => true, 'attr' => ['data-rule-required' => "true",'data-msg-required' => 'Please enter the estimated start date for the project',"class" => "datepicker" ]])
            ->add('estimatedenddate', DateType::class, ['label' => 'Estimated End Date','widget' => 'single_text','html5' => false, 'empty_data' => '', 'required' => true, 'attr' => ['data-rule-required' => "true","class" => "datepicker" ]])
            ->add('actualstartdate', DateType::class, ['label' => 'Actual Start Date','widget' => 'single_text','html5' => false, 'empty_data' => '', 'required' => false, 'attr' => ['data-rule-required' => "false", 'data-msg-required' => "Please enter the actual start date for the project","class" => "datepicker" ]])
            ->add('actualenddate', DateType::class, ['label' => 'Actual End Date','widget' => 'single_text','html5' => false, 'empty_data' => '', 'required' => false, 'attr' => ['data-rule-required' => "false", 'data-msg-required' => "Please enter the actual end date for the rate","class" => "datepicker" ]])
            ->add('status')
            ->add('immediatesupervisorname')
            ->add('immediatesupervisorphone')
            ->add('immediatesupervisoremail')
            ->add('supervisorname')
            ->add('supervisorphone')
            ->add('supervisoremail')
            ->add('notes')
            ->add('ponumber')
            ->add('taskcode')
            ->add('type')
            ->add('sprintcount')
            ->add('sprintduration')
            ->add('uuid', HiddenType::class, ['data' => $this->getUuid()->toString()])
            ->add('id', HiddenType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
            'account' => null,
        ]);
    }
}
