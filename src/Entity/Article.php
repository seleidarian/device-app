<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Config\ArticleTypes;
use App\Config\ArticleAims;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
class Article
{
    const DESCRIPTION_PATH = '/uploads/documents/';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true, enumType: ArticleTypes::class)]
    private ?ArticleTypes $type = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $frequency = null;

    #[Vich\UploadableField(mapping: 'articles', fileNameProperty: 'photo')]
    private ?File $photoFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo_spectr = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true, enumType: ArticleAims::class)]
    private ?ArticleAims $aim = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $targets = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(nullable: true)]
    private ?int $bandwidth = null;

    #[ORM\Column(nullable: true)]
    private ?int $width = null;

    #[ORM\Column(nullable: true)]
    private ?bool $signal = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $bpla_signal_kind = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $bpla_la_type = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $bpla_engine = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $bpla_signal_type = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $bpla_mode = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true, enumType: WorkMode::class)]
    private ?WorkMode $work_mode = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true, enumType: WorkType::class)]
    private ?WorkType $work_type = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $barrier_type = null;

    #[ORM\OneToMany(mappedBy: 'article_id', targetEntity: Images::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $images;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->created_at = new \DateTimeImmutable();
        $this->setUpdatedAtValue();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updated_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?ArticleTypes
    {
        return $this->type;
    }

    public function setType(ArticleTypes $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getFrequencyView(): ?array
    {
        $arr = [];

        if (is_array($this->frequency)) {
            foreach ($this->frequency as $step) {
                $arr[] = implode('-', $step);
            }
        }

        return $arr;
    }

    public function getFrequency(): ?array
    {
        // $arr = [];

        // if (is_array($this->frequency)) {
        //     foreach ($this->frequency as $step) {
        //         $arr[] = implode('-', $step);
        //     }
        // }

        return $this->frequency;
    }

    public function setFrequency(?array $frequency): static
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getPhotoFile(): ?File
    {
        return $this->photoFile;
    }

    public function setPhotoFile(?File $photo): static
    {
        $this->photoFile = $photo;

        return $this;
    }


    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPhotoSpectr(): ?string
    {
        return $this->photo_spectr;
    }

    public function setPhotoSpectr(?string $photo_spectr): static
    {
        $this->photo_spectr = $photo_spectr;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionUrl()
    {
        return $this->getDescription() ? self::DESCRIPTION_PATH . $this->getDescription() : '';
    }

    public function getAim(): ?ArticleAims
    {
        return $this->aim;
    }

    public function setAim(?ArticleAims $aim): static
    {
        $this->aim = $aim;

        return $this;
    }

    public function getTargets(): ?array
    {
        return $this->targets;
    }

    public function setTargets(?array $targets): static
    {
        $this->targets = $targets;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getBandwidth(): ?int
    {
        return $this->bandwidth;
    }

    public function setBandwidth(?int $bandwidth): static
    {
        $this->bandwidth = $bandwidth;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function isSignal(): ?bool
    {
        return $this->signal;
    }

    public function setSignal(?bool $signal): static
    {
        $this->signal = $signal;

        return $this;
    }

    public function getBplaSignalKind(): ?int
    {
        return $this->bpla_signal_kind;
    }

    public function setBplaSignalKind(?int $bpla_signal_kind): static
    {
        $this->bpla_signal_kind = $bpla_signal_kind;

        return $this;
    }

    public function getBplaLaType(): ?int
    {
        return $this->bpla_la_type;
    }

    public function setBplaLaType(?int $bpla_la_type): static
    {
        $this->bpla_la_type = $bpla_la_type;

        return $this;
    }

    public function getBplaEngine(): ?int
    {
        return $this->bpla_engine;
    }

    public function setBplaEngine(?int $bpla_engine): static
    {
        $this->bpla_engine = $bpla_engine;

        return $this;
    }

    public function getBplaSignalType(): ?int
    {
        return $this->bpla_signal_type;
    }

    public function setBplaSignalType(?int $bpla_signal_type): static
    {
        $this->bpla_signal_type = $bpla_signal_type;

        return $this;
    }

    public function getBplaMode(): ?int
    {
        return $this->bpla_mode;
    }

    public function setBplaMode(?int $bpla_mode): static
    {
        $this->bpla_mode = $bpla_mode;

        return $this;
    }

    public function getWorkMode(): ?WorkMode
    {
        return $this->work_mode;
    }

    public function setWorkMode(?WorkMode $work_mode): static
    {
        $this->work_mode = $work_mode;

        return $this;
    }

    public function getWorkType(): ?WorkType
    {
        return $this->work_type;
    }

    public function setWorkType(?WorkType $work_type): static
    {
        $this->work_type = $work_type;

        return $this;
    }

    public function getBarrierType(): ?array
    {
        return $this->barrier_type;
    }

    public function setBarrierType(?array $barrier_type): static
    {
        $this->barrier_type = $barrier_type;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setArticleId($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getArticleId() === $this) {
                $image->setArticleId(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}

enum BplaSignalKind: int
{

    case Телеметрія = 1;
    case Керування = 2;
    case Відео = 3;
}

enum BplaLaType: int
{
    case Літак = 1;
    case Крило = 2;
    case Коптер = 3;
}

enum BplaEngine: int
{
    case Електро = 1;
    case ДВЗ = 2;
}

enum BplaSignalType: int
{
    case ППРЧ = 1;
    case ФРЧ = 2;
}

enum BplaMode: int
{
    case Аналог = 1;
    case Цифра = 2;
}

enum WorkMode: int
{
    case Розвідка = 1;
    case Подавлення = 2;

    case Пеленгация = 3;
    case Супровід = 4;
}

enum WorkType: int
{
    case Стаціонарний  = 1;
    case Мобільний = 2;

    case Окопний = 3;
}

enum BarrierType: int
{
    case Статичний = 1;
    case Змінний = 2;
}
