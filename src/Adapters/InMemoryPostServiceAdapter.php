<?php

namespace Hexablog\Adapters;

use Hexablog\Entity\Post;
use Hexablog\Port\PostRepositoryPort;

class InMemoryPostServiceAdapter implements PostRepositoryPort
{
    private array $postsRepository = [];

    public function save(Post $post): Post
    {
        $this->postsRepository[$post->uuid] = $post;

        return $post;
    }

    public function findOne(string $uuid): ?Post
    {
        return $this->postsRepository[$uuid] ?? null;
    }
}
