<?php

namespace App\Controller\Admin;

use App\Entity\JobOffer;
use App\Entity\Recruiter;
use App\Repository\RecruiterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\FormInterface;

class JobOfferCrudController extends AbstractCrudController
{
    public function __construct(EntityManagerInterface $em)
    {
      $this->em = $em;
    }

    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
      if($this->checkUserRole('ROLE_RECRUITER') && $this->getCurrentRecruiter() === null) {
        return $crud->setPageTitle('new', 'Vous devez compléter votre profil pour publier une offre !');
      }
      $crud->setPageTitle('new', 'Créer une offre' );
      return $crud->setPageTitle('index', 'Offres d\'emplois');
    }

    public function configureActions(Actions $actions): Actions
    {
      if($this->checkUserRole('ROLE_CONSULTANT') || $this->getCurrentRecruiter() === null) {
        return $actions
          ->remove(Crud::PAGE_INDEX, Action::NEW)
          ->remove(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER)
          ->remove(Crud::PAGE_NEW, Action::SAVE_AND_RETURN);
      }

      return $actions;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters):QueryBuilder {

      $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
      $currentRecruiter = $this->getCurrentRecruiter();

      if($this->checkUserRole('ROLE_RECRUITER')) {
          $qb->where('entity.recruiter_id = :id');
          $qb->setParameter('id', $currentRecruiter);

          return $qb;
      }

      return $qb;
    }

    public function configureFields(string $pageName): iterable
    {
      if($this->checkUserRole('ROLE_RECRUITER') && $this->getCurrentRecruiter() === null) {
        return [
          TextField::new('title', 'Titre')
          ->hideOnForm(),
        ];
      }
      $fields = [
        TextField::new('title', 'Titre'),
        TextField::new('location', 'Lieu'),
        TextEditorField::new('description', 'Description du poste'),
      ];

      if($this->checkUserRole('ROLE_CONSULTANT')) {
        $fields[] = BooleanField::new('is_checked', 'Valide/Non-valide');
      }

      return $fields;
    }

    public function createEntity(string $entityFqcn): JobOffer
    {
      $jobOffer = new JobOffer();
      $jobOffer->setRecruiterId($this->getCurrentRecruiter());

      return $jobOffer;
    }

    public function getCurrentRecruiter()
    {
      $user = $this->getUser();

      if($this->checkUserRole('ROLE_RECRUITER')) {
        $recruiterRepository = $this->em->getRepository(Recruiter::class);
        return $recruiterRepository->findOneBy(['user_id_recruiter' => $user->getId()]);
      }
      return null;
    }

    public function checkUserRole(string $role)
    {
      $user = $this->getUser();

      if(in_array($role,$user->getRoles())) {
        return true;
      }
      return false;
    }
}
