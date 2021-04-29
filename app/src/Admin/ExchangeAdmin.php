<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Exchange;
use App\Entity\Place;
use App\Form\Type\PointType;
use App\Repository\PlaceRepository;
use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ExchangeAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('addressLine1')
            ->add('addressLine2')
            ->add('zipCode')
            ->add('pt')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('name')
            ->add('addressLine1')
            ->add('addressLine2')
            ->add('zipCode')
            ->add('city.name')
            ->add('pt')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
        dump($this);
    }

    protected function configureFormFields(FormMapper $form): void
    {

        $q = $this->getModelManager()->createQuery(Place::class, 'p');
        $qb = $q->getQueryBuilder();
        $qb->andWhere('p.lvl = 3');

        $form
            ->add('name')
            ->add('addressLine1')
            ->add('addressLine2')
            ->add('city', ModelType::class, [
                'query' => $q
            ], [
                'admin_code'   => 'admin.country'
            ])
            ->add('zipCode')
            ->add('pt', PointType::class)
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('addressLine1')
            ->add('addressLine2')
            ->add('zipCode')
            ->add('pt')
            ;
    }
}
