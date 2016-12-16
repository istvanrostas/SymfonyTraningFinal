<?php

namespace CoreBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class JobType extends AbstractType
{

//    private $tokenStorage;
//
//    public function __construct(TokenStorageInterface $tokenStorage)
//    {
//        $this->tokenStorage = $tokenStorage;
//    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'full-time' => 'full-time',
                    'part-time' => 'part-time',
                    'freelancer' => 'freelancer',
                ],
                'multiple' => false,
                'expanded' => true,

            ])
            ->add('location', TextType::class)
            ->add('position', TextType::class)
            ->add('company', TextType::class)
            ->add('url', TextType::class)
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => 4,
                    'cols' => 30
                ]
            ])
            ->add('email', EmailType::class)
            ->add('howToApply',TextareaType::class,[
                'attr' => [
                    'rows' => 4,
                    'cols' => 30
                ]
            ])
            ->add('category', EntityType::class,[
                'class' => 'CoreBundle:Category'
            ]);

        //adminon zavart okozott
//        $user = $this->tokenStorage->getToken()->getUser();
//        if (!$user) {
//            throw new \LogicException(
//                'The adding job cannot be used without an authenticated user!'
//            );
//        }
//
//        $builder->add('user', EntityType::class, [
//            'class' => 'CoreBundle:User',
//            'query_builder' => function (EntityRepository $er) use ($user){
//                return $er->createQueryBuilder('u')->where('u.id = :id')->setParameter('id', $user->getId());
//            }
//        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreBundle\Entity\Job'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'corebundle_job';
    }


}
