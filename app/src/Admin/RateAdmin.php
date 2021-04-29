<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Currency;
use App\Entity\Exchange;
use App\Entity\OrderType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class RateAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('value')
            ->add('createdAt')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('exchange.name')
            ->add('exchange.addressLine1')
            ->add('exchange.city.name')
            ->add('currencySource.code')
            ->add('currencyTarget.code')
            ->add('orderType.code')
            ->add('value')
            ->add('createdAt')
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
        $form
            ->add('exchange', EntityType::class, [
                'class' => Exchange::class
            ])
            ->add('currencySource', EntityType::class, [
                'class' => Currency::class
            ])
            ->add('currencyTarget', EntityType::class, [
                'class' => Currency::class
            ])
            ->add('orderType', EntityType::class, [
                'class' => OrderType::class
            ])
            ->add('value')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('value')
            ->add('createdAt')
            ;
    }
}
