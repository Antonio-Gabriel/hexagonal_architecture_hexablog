<?php

namespace Hexablog\Port;

use Hexablog\Entity\Post;

interface PostRepositoryPort
{
    public function save(Post $post): Post;
    public function findOne(string $uuid): ?Post;
}
