<?php

namespace Hexablog\Adapters;

use DateTime;
use Hexablog\Entity\Post;
use Hexablog\Port\PostRepositoryPort;

use Hexablog\Sql\Mysql;

class PostServiceAdapter implements PostRepositoryPort
{
    private Mysql $sql;

    public function __construct()
    {
        $this->sql = new Mysql([
            "host"      => "127.0.0.1",
            "user"      => "root",
            "password"  => "",
            "dbname"    => "blog",
            "driver"    => "pdo_mysql",
        ]);
    }

    public function save(Post $post): Post
    {
        $builder = $this->sql->createQueryBuilder();
        $stmt = $builder->insert("post")
            ->values(["id" => "?", "title" => "?", "content" => "?", "publishedAt" => "?"])
            ->setParameter(0, $post->uuid)
            ->setParameter(1, $post->title)
            ->setParameter(2, $post->content)
            ->setParameter(
                3,
                $post->publishedAt
                    ? $post->publishedAt->format("Y-m-d H:i:s")
                    : null
            );

        $result = $stmt->execute();

        if ($result) {
            return $post;
        }
    }

    public function findOne(string $uuid): ?Post
    {
        $query = $this->sql->createQueryBuilder();
        $result = $query
            ->select("*")
            ->from("post")
            ->where("id = ?")
            ->setParameter(0, $uuid)
            ->fetchAllAssociative()[0];

        if (!$result) {
            return null;
        }
        
        return new Post(
            $result['title'],
            $result['content'],
            ($result['publishedAt']
                ? new DateTime($result['publishedAt'])
                : null),
            $result['id']
        );
    }
}
