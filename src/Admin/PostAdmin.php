<?php

namespace App\Admin;

use App\Entity\Category;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('titulo', null, [
            'label' => 'Titulo'
        ])
        ->add('category', null, [
            'label' => 'Categoria',
            'associated_property' => 'name',
            'editable' =>true
        ])
        ->add('status', 'boolean', [
            'editable' => true
        ])
        ;
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->tab('Post')
                ->with('post')
                    ->add('titulo', TextType::class, [
                        'label' => 'Nome'
                    ])
                    ->add('description', TextareaType::class, [
                        'label' => 'Descrição'
                    ])
                    ->add('status')
                ->end()
            ->end()
            ->tab('Categoria')
                ->with('categoria')
                    ->add('category', ModelAutocompleteType::class, [
                        'class' => Category::class,
                        'property' => 'name',
                        'multiple' => true,
                        'callback' => function($admin, $property, $value){
                            $datagrid = $admin->getDatagrid();
                            $queryBuilder = $datagrid->getQuery();
                            $queryBuilder
                                ->andWhere($queryBuilder->getRootAlias() . '.name LIKE :filter')
                                ->setparameter('filter', '%' .$admin->getRequest()->get('q') . '%');

                            $datagrid->setValue($property, null, $value);
                        },
                        'btn_add' =>'adicionar'
                    ])
                ->end()
            ->end()
            ->tab('Media')
                ->with('Media')
                    ->add('imagem', ModelListType::class)
                    ->add('galeria', ModelListType::class)
                ->end()
            ->end()

            ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid
            ->add('titulo')
            ->add('category', null, [], EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true
            ]) 
            ;
    }

    protected function configureRoutes(RouteCollection $routes)
    {
        $routes->remove('delete');
    }

    public function toString($object)
    {
        return $object instanceof Post ? $object->getName() : "Nova post";
    }
}