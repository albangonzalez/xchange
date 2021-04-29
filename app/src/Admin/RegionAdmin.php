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

final class RegionAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'admin_app_region';
    protected $baseRoutePattern =  'region';

    protected function configureQuery(ProxyQueryInterface $query): ProxyQueryInterface
    {
        $query = parent::configureQuery($query);
        $rootAlias = current($query->getRootAliases());

        $query->andWhere(
            $query->expr()->eq($rootAlias . '.lvl', ':lvl')
        );
        $query->setParameter('lvl', 2);

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
        $qb->andWhere('p.lvl = 1');

        $form
            ->add('name')
            ->add('code')
            ->add('parent', ModelType::class, [
                'class' => Place::class,
                'query' => $q,
                'label' => 'country'
            ], [
                'admin_code'   => 'admin.country',
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('code')
            ->add('parent.name')
            ;
    }
}
