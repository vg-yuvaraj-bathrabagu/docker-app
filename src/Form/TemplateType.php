<?php

namespace App\Form;


use App\Entity\Conversion;
use App\Entity\Simulation;
use App\Entity\Template;
use App\Helper\LookupValues;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TemplateType extends AbstractType
{
    use LookupValues;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("name", TextType::class, [
            "constraints" => [new NotBlank()]
        ]);
        $builder->add('format', ChoiceType::class, [
            "constraints" => [new NotBlank()],
            "choices" => $this->getFileTemplateFormats(),
            "attr" => ["data-rule-required" => "true", "data-msg-required" =>"Please select the format processed by the template"]
        ]);
        $builder->add('datatype', ChoiceType::class, [
            "constraints" => [new NotBlank()],
            "choices" => $this->getTemplateDataTypes(),
            "attr" => ["data-rule-required" => "true", "data-msg-required" =>"Please select the datatype for the column"]
        ]);

        $builder->add('type', ChoiceType::class, [
            "constraints" => [new NotBlank()],
            "data" => "User",
            "choices" => $this->getTemplateCreationTypes(),
            "attr" => ["data-rule-required" => "true", "data-msg-required" =>"Please select the template type"]
        ]);

        $builder->add("processing", EntityType::class, [
            "class" => Conversion::class,
            'required' => false,
            "query_builder" => function (EntityRepository $er) {
                return $er->createQueryBuilder("t")->where("t.isactive = 1");
            }
        ]);

        $builder->add("simulationid", EntityType::class, [
            "class" => Simulation::class,
            'required' => false,
            "query_builder" => function (EntityRepository $er) use($options) {
                return $er->createQueryBuilder("t")->where("t.account = ".$options['account']);
            }
        ]);

       $builder->add('delimiter', ChoiceType::class, [
            "label" => "Delimiter",
            "constraints" => [new NotBlank()],
            "choices" => $this->getDelimiters(),
            "attr" => ["data-rule-required" => "true",
                "data-msg-required" =>"Please select the delimiter",

            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Template::class,
            'account' => null,
        ));
    }
}