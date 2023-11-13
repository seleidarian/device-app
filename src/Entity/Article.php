<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Config\ArticleTypes;
use App\Config\ArticleAims;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', nullable: true, enumType: ArticleTypes::class)]
    private ?ArticleTypes $type = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $frequency = null;

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

    const DESCRIPTION_PATH = '/uploads/documents/';

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
        return self::DESCRIPTION_PATH . $this->getDescription();
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
}
