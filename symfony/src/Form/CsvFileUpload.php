<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class CsvFileUpload extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'file',
            FileType::class,
            [
                'label' => "Add csv file to parse",
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => ['text/csv'],
                        'mimeTypesMessage' => 'Wrong file extension',
                    ])
                ],
            ]
        );
        $builder->add(
            'send',
            SubmitType::class,
            [
                'label' => 'Send data',
            ]
        );
        parent::buildForm($builder, $options);
    }
}