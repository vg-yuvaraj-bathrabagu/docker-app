<?php
/**
 * Form for file uploads mainly to render the list
 */

namespace App\Form;


use App\Entity\Template;
use App\Helper\LookupValues;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LookupValuesType extends AbstractType
{

    use LookupValues;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("template", EntityType::class, [
            "class" => Template::class,
            "label" => "Template",
            "query_builder" => function (EntityRepository $er) {
                    return $er->createQueryBuilder("t")->where("t.isactive = 1");
            },
            "attr" => ["data-rule-required"=>"true", "data-msg-required"=>"Please select the template to process the file"]
        ]);


    }
}