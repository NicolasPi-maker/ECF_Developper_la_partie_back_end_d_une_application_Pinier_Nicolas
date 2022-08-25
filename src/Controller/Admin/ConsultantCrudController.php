<?php

namespace App\Controller\Admin;

use App\Entity\Consultant;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Repository\ConsultantRepository;

class ConsultantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Consultant::class;
    }


  public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('username', 'Nom d\'utilisateur'),
            AssociationField::new('user_id_consultant', 'identifiant')
              ->hideWhenUpdating()
        ];
    }

}
