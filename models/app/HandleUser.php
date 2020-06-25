<?php
    class HandleUser{
        private $conn;

        //get user id by email or username
        public function getId($email){
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);

            return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
        }

        //check if that user already rated a specific game
        public function isAlreadyRated($user_id,$game_id){
            $stmt = $this->conn->prepare("SELECT user_id FROM rate WHERE game_id = ? AND user_id > 0 LIMIT 1");
            $stmt->execute([$game_id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['user_id'] == $user_id ? true : false;
        }

        public function __construct($db){
            $this->conn = $db;
        }
    }