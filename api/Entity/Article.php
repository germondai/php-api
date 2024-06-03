<?php

declare(strict_types=1);

namespace Api\Entity;

use Api\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'articles')]
class Article extends BaseEntity
{
    #[ORM\Column(type: 'string', length: 256)]
    private string $title;

    #[ORM\Column(type: 'string')]
    private string $content;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}