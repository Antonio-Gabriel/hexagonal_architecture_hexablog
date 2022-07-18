<?php

namespace Hexablog\UseCase;

use Assert\Assert;
use Assert\LazyAssertionException;

use DateTimeInterface;
use Hexablog\Entity\Post;
use Hexablog\Port\PostRepositoryPort;

class CreatePost
{
    public function __construct(
        private PostRepositoryPort $inMemoryRepository
    ) {
    }

    public function execute(array $postData): ?Post
    {
        $post = new Post($postData['title'], $postData['content'], $postData['publishedAt']);

        try {
            $this->validate($post);

            $stmt = $this->inMemoryRepository->save($post);

            return $stmt;
        } catch (LazyAssertionException $e) {
            throw new \Hexablog\Exception\InvalidPostDataException($e->getValue());
        }
    }

    protected function validate(Post $post)
    {
        Assert::lazy()
            ->that($post->title)->notBlank()->minLength(3)
            ->that($post->content)->notBlank()->minLength(10)
            ->that($post->publishedAt)->nullOr()->isInstanceOf(DateTimeInterface::class)
            ->verifyNow();
    }
}
