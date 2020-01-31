<?php

namespace App\Form;

use App\Entity\TaskCategory;
use App\Helper\Utils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskCategoryType extends AbstractType
{
    use Utils;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['attr' => ['data-rule-required' => "true", 'data-msg-required' => "Please enter the category title"]])
            ->add('description', TextType::class, ['required' => false])
            ->add('id', HiddenType::class)
            ->add('uuid', HiddenType::class, ['data' => $this->getUuid()->toString()]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TaskCategory::class,
            'account' => null,
        ]);
    }
}
