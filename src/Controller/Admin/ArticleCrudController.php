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
use App\Form\Type\GenerationFilterType;

use App\Config\ArticleTypes;
use App\Config\ArticleAims;
use App\Entity\BarrierType;
use App\Entity\BplaEngine;
use App\Entity\BplaLaType;
use App\Entity\BplaMode;
use App\Entity\BplaSignalKind;
use App\Entity\BplaSignalType;
use App\Entity\Images;
use App\Entity\WorkMode;
use App\Entity\WorkType;
use App\Form\ImageAttachmentType;
use App\Form\Type\CollectionFileType;
use Doctrine\Common\Collections\Collection;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\ArrayFilterType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\ChoiceFilterType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;

use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use PhpParser\Node\Expr\Cast\Array_;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Choice;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return
            $actions->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->setPermission(Action::NEW, 'ROLE_MODERATOR')
            ->setPermission(Action::EDIT, 'ROLE_MODERATOR')
            ->setPermission(Action::DELETE, 'ROLE_MODERATOR');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->showEntityActionsInlined()
            ->setPageTitle(Crud::PAGE_INDEX, 'Пристрої');
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')
            ->setLabel('Назва');

        yield ChoiceField::new('type')
            ->setLabel('Тип')
            ->setRequired(true)
            ->renderExpanded()
            ->setColumns(2)
            ->setFormTypeOptions([
                'choice_label' => fn (?ArticleTypes $choice) => $choice->name,
                'choice_attr' => fn ($choice, string $key, mixed $value) => match ($choice->name) {
                    'BPLA' => [
                        'data-type' => 'bpla',
                        'data-targets' => "Ударний Розвідувальний Камікадзе FPV"
                    ],
                    'RLS' => [
                        'data-type' => 'rls',
                        'data-targets' => "Небо Земля Навігація"
                    ],
                    'REB' => [
                        'data-type' => 'reb',
                        'data-targets' => "Небо Земля Контрбатарейна Зенiтна"
                    ]
                }
            ]);

        yield ChoiceField::new('targets')
            ->setLabel('Призначення')
            ->allowMultipleChoices()
            ->renderExpanded()
            ->setColumns(2)
            ->setSortable(false)
            ->setChoices(ArticleAims::array());

        yield ArrayField::new('frequency')
            ->setFormTypeOption('entry_type', FrequencyType::class)
            ->setLabel('Частоти')
            ->setSortable(false)
            ->setColumns(8)
            ->onlyOnForms();

        yield ArrayField::new('frequency_view')
            ->setLabel('Частоти')
            ->setSortable(false)
            ->formatValue(function ($value) {

                return str_replace(',', '<br>', $value);

                $values = explode(',', $value);
                $ret = [];
                foreach ($values as $_index => $value) {
                    $ret[] = $value;

                    if ($_index !== array_key_last($values)) {
                        $ret[] =  ($_index && $_index % 2) ? '<br>' : ',';
                    }
                }

                return implode($ret);
            })
            ->hideOnForm();


        yield ChoiceField::new('bpla_signal_kind')
            ->renderExpanded()
            ->setCssClass('bpla additional-fields')
            ->setColumns(2)
            ->hideOnIndex()
            ->setChoices(BplaSignalKind::cases());

        yield ChoiceField::new('bpla_la_type')
            ->renderExpanded()
            ->setCssClass('bpla additional-fields')
            ->setColumns(2)
            ->hideOnIndex()
            ->setChoices(BplaLaType::cases());

        yield ChoiceField::new('bpla_engine')
            ->renderExpanded()
            ->setCssClass('bpla additional-fields')
            ->setColumns(2)
            ->hideOnIndex()
            ->setChoices(BplaEngine::cases());

        yield ChoiceField::new('bpla_signal_type')
            ->renderExpanded()
            ->setCssClass('bpla additional-fields')
            ->setColumns(2)
            ->hideOnIndex()
            ->setChoices(BplaSignalType::cases());

        yield ChoiceField::new('bpla_mode')
            ->renderExpanded()
            ->setCssClass('bpla additional-fields')
            ->setColumns(4)
            ->hideOnIndex()
            ->setChoices(BplaMode::cases());


        yield ChoiceField::new('work_mode')
            ->renderExpanded()
            ->setCssClass('work_mode reb rls additional-fields')
            ->setColumns(2)
            ->hideOnIndex()
            ->setFormTypeOptions([
                'choice_label' => fn (?WorkMode $choice) => $choice->name,
                'choice_attr' => fn ($choice, string $key, mixed $value) => match ($choice->name) {
                    'Розвідка' => ['data-type' => 'reb rls'],
                    'Подавлення' => ['data-type' => 'reb'],
                    'Пеленгация' => ['data-type' => 'rls'],
                    'Супровід' => ['data-type' => 'rls']
                }
            ]);


        yield ChoiceField::new('work_type')
            ->renderExpanded()
            ->setCssClass('reb rls additional-fields')
            ->setColumns(2)
            ->hideOnIndex()
            ->setFormTypeOptions([
                'choice_label' => fn (?WorkType $choice) => $choice->name,
                'choice_attr' => fn ($choice, string $key, mixed $value) => match ($choice->name) {
                    'Стаціонарний' => ['data-type' => 'reb rls'],
                    'Мобільний' => ['data-type' => 'reb rls'],
                    'Окопний' => ['data-type' => 'reb']
                }
            ]);


        yield ChoiceField::new('barrier_type')
            ->renderExpanded()
            ->allowMultipleChoices()
            ->setCssClass('reb additional-fields')
            ->setColumns(8)
            ->hideOnIndex()
            ->setChoices(BarrierType::cases());

        yield FormField::addPanel();

        yield BooleanField::new('signal')
            ->setColumns(2)
            ->setLabel('Signal')
            ->hideOnIndex();

        yield IntegerField::new('bandwidth')
            ->setColumns(2)
            ->setFormTypeOption('row_attr', [
                'class' => 'bandwidth'
            ])
            ->setLabel('Bandwidth')
            ->hideOnIndex();

        yield IntegerField::new('duration')
            ->setColumns(2)
            ->setFormTypeOption('row_attr', [
                'class' => 'duration'
            ])
            ->setLabel('Duration')
            ->hideOnIndex();

        yield IntegerField::new('width')
            ->setColumns(2)
            ->setFormTypeOption('row_attr', [
                'class' => 'width'
            ])
            ->setLabel('Ширина')
            ->hideOnIndex();

        yield FormField::addPanel();

        yield CollectionField::new('images')
            ->setEntryType(ImageAttachmentType::class)
            //->setEntryType(VichImageType::class)
            //->setFormType(VichImageType::class)
            //->setFormTypeOption('by_reference', false)
            ->onlyOnForms();

        yield CollectionField::new('images')
            ->setTemplatePath('images.html.twig')
            ->onlyOnDetail();

        // yield TextField::new('photoFile')
        //     ->setFormType(VichImageType::class)
        //     ->setLabel('Фото')
        //     ->setSortable(false)
        //     ->onlyOnForms();

        yield CollectionField::new('images')
            ->setLabel('Фото')
            ->setSortable(false)
            ->setTemplatePath('article/gallery-index.html.twig')
            ->onlyOnIndex();

        // yield ImageField::new('photo')
        //     ->setBasePath('uploads/images/')
        //     ->setUploadDir('public/uploads/images/')
        //     ->hideOnForm();

        yield ImageField::new('photo_spectr')
            ->setLabel('Фото спектру')
            ->setSortable(false)
            ->setBasePath('uploads/images/')
            ->setUploadDir('public/uploads/images/');

        yield ImageField::new('description')
            ->setLabel('Опис')
            ->setBasePath('uploads/documents/')
            ->setUploadDir('public' . Article::DESCRIPTION_PATH)
            ->setSortable(false)
            ->setFormTypeOptions([
                'attr' => [
                    'accept' => 'application/pdf, application/msword'
                ]
            ])->onlyOnForms();

        yield TextField::new('description_url')
            ->setLabel('Документ')
            ->setTemplatePath('admin/field/document_link.html.twig')
            ->hideOnForm();
    }



    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(
                ArrayFilter::new('type')
                    ->setChoices(ArticleTypes::array())
            )
            ->add(
                ArrayFilter::new('targets')
                    ->setFormType(GenerationFilterType::class)
                    ->canSelectMultiple()
                    ->setChoices(ArticleAims::array())
            );
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addWebpackEncoreEntry('app');
    }
}
