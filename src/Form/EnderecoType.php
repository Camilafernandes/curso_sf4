<?php

namespace App\Form;

use App\Entity\Endereco;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class EnderecoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logradouro', TextType::class, [
                'label' => 'Rua',
                'attr' => [
                    'placeholder' => 'Informe o nome da rua'
                ]
            ])
            ->add('cep', TextType::class, [
                'label' => 'Cep',
                'attr' => [
                    'placeholder' => 'Informe o CEP'
                ]
            ])
            ->add('cidade', TextType::class, [
                'label' => 'Cidade',
                'attr' => [
                    'placeholder' => 'Informe a Cidade'
                ]
            ])
            ->add('estado', TextType::class, [
                'label' => 'Estado',
                'attr' => [
                    'placeholder' => 'Informe o estdo'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Endereco::class,
        ]);
    }
}
