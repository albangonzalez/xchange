<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Place;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

final class CityAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'admin_app_city';
    protected $baseRoutePattern =  'city';

    protected function configureQuery(ProxyQueryInterface $query): ProxyQueryInterface
    {
        $query = parent::configureQuery($query);
        $rootAlias = current($query->getRootAliases());

        $query->andWhere(
            $query->expr()->eq($rootAlias . '.lvl', ':lvl')
        );
        $query->setParameter('lvl', 3);

        return $query;
    }
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('code')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('name')
            ->add('code')
            ->add('parent.name')
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
        $qb->andWhere('p.lvl = 2');

        $form
            ->add('name')
            ->add('code')
            ->add('parent', ModelType::class, [
                'class' => Place::class,
                'query' => $q,
                'label' => 'region'
            ], [
                'admin_code'   => 'admin.region',
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('code')
            ;
    }
}
