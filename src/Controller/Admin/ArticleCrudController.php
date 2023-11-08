<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\Type\FrequencyType;
use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\BigIntType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ArrayFilter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use function Psr\Log\debug;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

use App\Config\ArticleTypes;
use App\Config\ArticleAims;


class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return
            $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->showEntityActionsInlined();
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')
            ->setLabel('Назва');

        yield ChoiceField::new('type')
            ->setLabel('Тип')
            ->setFormTypeOptions([
                'choice_label' => function (ArticleTypes|int|string $choice): string {
                    return $choice->name;
                }
            ]);

        yield ChoiceField::new('aim')
            ->setLabel('Призначення')
            ->setFormTypeOptions(
                [
                    'choice_label' => function (ArticleAims|int|string $choice): string {
                        return $choice->name;
                    }
                ]
            );

        yield ArrayField::new('frequency_view')
            ->setLabel('Частоти')
            ->setSortable(false)
            ->hideOnForm();

        yield ArrayField::new('frequency')
            ->setFormTypeOption('entry_type', FrequencyType::class)
            ->setSortable(false)
            ->onlyOnForms();

        yield ImageField::new('photo')
            ->setLabel('Фото')
            ->setSortable(false)
            ->setBasePath('uploads/images/')
            ->setUploadDir('public/uploads/images/');

        yield ImageField::new('photo_spectr')
            ->setLabel('Фото спектру')
            ->setSortable(false)
            ->setBasePath('uploads/images/')
            ->setUploadDir('public/uploads/images/');

        yield TextareaField::new('description')
            ->setLabel('Опис')
            ->setSortable(false);
    }



    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(
                ArrayFilter::new('type')
                    ->setChoices(ArticleTypes::array())
            )
            ->add(
                ArrayFilter::new('aim')
                    ->setChoices(ArticleAims::array())
            );
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addWebpackEncoreEntry('app');
    }
}