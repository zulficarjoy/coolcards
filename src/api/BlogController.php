<?php

class BlogController {
    private $db;

    public function __construct($db) { 
        $this->db = $db;
    }

    public function createPost($title, $content) {
        try {
            if (strlen($title) > 50) {
                throw new Exception("Title cannot exceed 50 characters.");
            }
            $stmt = $this->db->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
            $stmt->execute([$title, $content]);
            echo "Post created successfully";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getPosts() {
        $stmt = $this->db->query("SELECT * FROM posts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePost($id, $title, $content) {
        try {
            if (strlen($title) > 50) {
                throw new Exception("Title cannot exceed 50 characters.");
            }
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM posts WHERE id = ?");
            $stmt->execute([$id]);
            if ($stmt->fetchColumn() == 0) {
                throw new Exception("Post not found.");
            }
            $stmt = $this->db->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
            $stmt->execute([$title, $content, $id]);
            echo "Post updated successfully";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deletePost($id) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM posts WHERE id = ?");
            $stmt->execute([$id]);
            if ($stmt->fetchColumn() == 0) {
                throw new Exception("Post not found.");
            }
            $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
            $stmt->execute([$id]);
            echo "Post deleted successfully";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?> 