<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 09.02.2018
 * Time: 19:36
 */

namespace App\Form;


use App\Entity\Link;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('link', UrlType::class,['label' => 'Put your URL here'])
            ->add('Get the Link!', SubmitType::class)
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Link::class,
        ));
    }

}