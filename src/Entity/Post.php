<?php

namespace Hexablog\Entity;

use DateTimeInterface;

class Post
{
    public function __construct(
        public string $title,
        public string $content,
        public ?DateTimeInterface $publishedAt = null,
        public ?string $uuid = null
    ) {
        $this->uuid = $uuid ?? uniqid();
    }
}
