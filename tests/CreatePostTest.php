<?php

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;

use Hexablog\UseCase\CreatePost;
use Hexablog\Entity\Post;

use Hexablog\Adapters\InMemoryPostServiceAdapter;
use Hexablog\Adapters\PostServiceAdapter;
use Hexablog\Exception\InvalidPostDataException;

it("should create a post", function () {
    // $repository = new InMemoryPostServiceAdapter();
    $repository = new PostServiceAdapter();

    $useCase = new CreatePost($repository);

    $post = $useCase->execute([
        "title" => "Create an architecture using Php",
        "content" => "The principal idea is learn about differents concepts",
        "publishedAt" => new DateTime()
    ]);

    assertInstanceOf(Post::class, $post);
    assertEquals($post->uuid, $repository->findOne($post->uuid)->uuid, "Is not equal");
});

it("should throw a InvalidPostDataException if bad data is provided", function ($postData) {
    $repository = new InMemoryPostServiceAdapter();
    $useCase = new CreatePost($repository);

    $post = $useCase->execute($postData);
})->with([
    [['title' => 'Post title', 'content' => '', 'publishedAt' => new DateTime()]],    
])->throws(InvalidPostDataException::class);
