<?php

namespace App\Form;

use App\Form\CargoType;
use App\Entity\Candidato;
use App\Form\EnderecoType;
use App\Form\HistoricoType;
use App\Form\TecnologiasType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class CandidatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, [
                'label' => 'Nome',
                'attr' => [
                    'placeholder' => 'Informe o nome'
                ]
            ])
            ->add('idade', NumberType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 120,
                    'step' => 1,
                    'placeholder' => "Informe sua idade",
                ]
            ])
            ->add('sexo', ChoiceType::class, [
                'choices' =>[
                    'M' => 'Maculino',
                    'F' => 'Feminino'
                ]
            ])
            ->add('data_nascimento',  BirthdayType::class, [
                'format' => 'dd-MM-yyyy'
            ])
            ->add('pretensao_salarial', MoneyType::class, [
                'currency' => 'BRL'
            ])
            ->add('foto', FileType::class, [
                'label' => 'Selecione uma foto'
            ])
            ->add('cargo', CargoType::class)
            ->add('endereco',  EnderecoType::class)
            ->add('tecnologias', TecnologiasType::class)
            ->add('historico', HistoricoType::class)
            ->add('btn_salvar', SubmitType::class, [
                'label' => 'Salvar'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidato::class,
        ]);
    }
}
