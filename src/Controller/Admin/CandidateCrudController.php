<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Symfony\Component\Validator\Constraints\Image;
use Vich\UploaderBundle\Form\Type\VichFileType;

class CandidateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidate::class;
    }

    public function configureActions(Actions $actions): Actions
    {
      return $actions
        ->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    public function configureCrud(Crud $crud): Crud
    {
      $crud->setPageTitle('index', 'Candidat' );
      return $crud->setPageTitle('edit', 'Modifier un Candidat');
    }


    public function configureFields(string $pageName): iterable
    {

      $user = $this->getUser();

     if(in_array('ROLE_CANDIDATE', $user->getRoles())) {
        return [
          TextField::new('name'),
          TextField::new('last_name'),
          TextField::new('curriculumFile'),
          ImageField::new('file_name')
            ->setBasePath('/uploads/files')
            ->setUploadDir('public/uploads/files'),
        ];
      }

        return [
            TextField::new('name', 'Nom'),
            TextField::new('last_name', 'Prénom'),
            AssociationField::new('user_id', 'Email')
              ->hideWhenUpdating(),
        ];
    }

}
