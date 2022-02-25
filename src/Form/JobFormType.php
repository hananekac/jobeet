<?php

namespace App\Form;
use App\Entity\Category;
use App\Entity\Job;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class,[
                'choices' => array_combine(Job::JOB_TYPE, Job::JOB_TYPE),
                'expanded' => true,
            ]
            )
            ->add('company', TextType::class)
            ->add('logo')
            ->add('url', UrlType::class)
            ->add('position')
            ->add('location')
            ->add('description', TextareaType::class)
            ->add('howToApply', TextareaType::class)
            ->add('token')
            ->add('email', EmailType::class)
            ->add('isActivated', ChoiceType::class, [
                'choices' => [
                    'yes' => 1,
                    'no' => 0
                ],
                'expanded' => true,

            ])
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class
        ]);
    }
}
