<?php

class BlogController {
    private $db;

    public function __construct($db) { 
        $this->db = $db;
    }

    public function createPost($title, $content) {
        if (strlen($title) > 50) {
            throw new Exception("Title cannot exceed 50 characters.");
        }
        $stmt = $this->db->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        $stmt->execute([$title, $content]);
    }

    public function getPosts() {
        $stmt = $this->db->query("SELECT * FROM posts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePost($id, $title, $content) {
        $stmt = $this->db->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $id]);
    }

    public function deletePost($id) {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?> 