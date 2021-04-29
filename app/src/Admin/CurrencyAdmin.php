<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Place;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

final class CurrencyAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('code')
            ->add('sign')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('name')
            ->add('code')
            ->add('sign')
            ->add('origin.name')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $q = $this->getModelManager()->createQuery(Place::class, 'p');
        $qb = $q->getQueryBuilder();
        $qb->andWhere('p.lvl = 1');

        $form
            ->add('name')
            ->add('code')
            ->add('sign')
            ->add('origin', ModelType::class, [
                'query' => $q
            ], [
                'admin_code'   => 'admin.country'
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('code')
            ->add('sign')
            ;
    }
}
