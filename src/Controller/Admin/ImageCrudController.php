<?php

// src/Controller/Admin/ImageCrudController.php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new(propertyName: 'nom'),
            Field::new('filePath')->setFormType(FileType::class)->setLabel('Import Image'),
            Field::new('image_display')->setLabel('Image')->onlyOnDetail()->setTemplatePath('admin/image_image_display.html.twig'),
            TextField::new(propertyName: 'description'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Image) {
            $file = $entityInstance->getFilePath(); // Récupère le fichier téléchargé
            if ($file instanceof UploadedFile) {
                // Lire directement le contenu du fichier téléchargé en binaire
                $imageData = file_get_contents($file->getPathname()); // Lire le fichier en binaire
                // Enregistrer les données binaires dans la base de données
                $entityInstance->setFilePath($imageData);
            }
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
}
