<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

  public function configureActions(Actions $actions): Actions
  {
    return $actions
      ->remove(Crud::PAGE_INDEX, Action::NEW);
  }

  public function configureCrud(Crud $crud): Crud
  {
    $crud->setPageTitle('index', 'Utilisateurs' );
    return $crud->setPageTitle('edit', 'Modifier un utilisateur');
  }

  public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters):QueryBuilder {

    $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
    $user = $this->getUser();

    if($this->checkUserRole('ROLE_CONSULTANT')) {
      $qb->where('entity.roles LIKE :role');
      $qb->setParameter('role', '%ROLE_RECRUITER%');
    }

    return $qb;
  }

    public function configureFields(string $pageName): iterable
    {
      if($this->checkUserRole('ROLE_CONSULTANT') || $this->checkUserRole('ROLE_ADMIN')) {
        return [
          EmailField::new('email','Adresse email')
            ->onlyOnIndex(),
          ArrayField::new('roles', 'Permission')
            ->onlyOnIndex(),
          BooleanField::new('is_checked', 'Actif/Non Actif'),
        ];
      }

        return [
            EmailField::new('email','Adresse email'),
        ];
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
