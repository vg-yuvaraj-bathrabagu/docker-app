<?php

namespace App\Form;


use App\Entity\CustomReport;
use App\Helper\LookupValues;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class QueryType extends AbstractType
{
    use LookupValues;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('type', ChoiceType::class, [
            "constraints" => [new NotBlank()],
            "choices" => $this->getTemplateCreationTypes(),
            "attr" => ["data-rule-required" => "true", "data-msg-required" =>"Please select the template type"]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CustomReport::class,
        ));
    }
}