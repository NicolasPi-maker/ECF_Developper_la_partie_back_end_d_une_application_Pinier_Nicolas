<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('last_name')
            ->add('fileName', FileType::class, [
              'mapped' => false,
              'required' => false,
              'constraints' => [
                new File([
                  'maxSize' => '1024k',
                  'mimeTypes' => [
                    'application/pdf',
                    'application/x-pdf',
                  ],
                  'mimeTypesMessage' => 'Vous devez ajouter un document au format Pdf'
                ])
              ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
