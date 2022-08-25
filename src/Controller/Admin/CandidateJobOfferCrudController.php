<?php

namespace App\Controller\Admin;

use App\Entity\CandidateJobOffer;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class CandidateJobOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CandidateJobOffer::class;
    }

    public function configureActions(Actions $actions): Actions
    {
      return $actions
        ->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters):QueryBuilder {

      $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        $qb->join('entity.candidate_id','c',['candidate_id = c.id']);

      return $qb;
    }

  public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('candidate_id', 'Candidat'),
            AssociationField::new('job_id', 'Offre'),
            BooleanField::new('is_checked', 'Valide/Non Valide'),
        ];
    }

}
