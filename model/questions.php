<?php
include_once("../config/db.php");
$dbconn = new Database();

class question {
    private $questionId;
    private $questionText;
    private $explanation;
    private $theme;

    public function __construct($questionId, $questionText, $explanation, $theme) {
        $this->questionId = $questionId;
        $this->questionText = $questionText;
        $this->explanation = $explanation;
        $this->theme = $theme;
    }

    public function getQuestionId() {
        return $this->questionId;
    }

    public function getQuestionText() {
        return $this->questionText;
    }

    public function getThemeName() {
        return $this->theme;
    }

    public function getExplanation() {
        return $this->explanation;
    }
}

class questionDAO {
    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function getQuestion() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM questions ");
            $stmt->execute();
            $allQuestions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $questions = array();

            foreach ($allQuestions as $question) {
                $questions[] = new question(
                    $question['question_id'],
                    $question['question_text'],
                    $question['explanation'],
                    $question['theme_id']
                );
            }
          
            

            return $questions;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function gettheme($idQuestion) {
        try {
            $stmt = $this->db->prepare("SELECT theme.theme_name FROM questions JOIN theme ON theme.theme_id = questions.theme_id WHERE questions.question_id = :id");
            $stmt->bindParam(":id", $idQuestion);
            $stmt->execute();
            $theme = $stmt->fetchColumn();
            return $theme;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getExplanation($idQuestion) {
        try {
            $stmt = $this->db->prepare("SELECT questions.question_text, answers.answer_text,  questions.explanation FROM questions JOIN answers ON answers.question_id = questions.question_id AND answers.isCorrect = 1 WHERE questions.question_id = :id;");
            $stmt->bindParam(":id", $idQuestion);
            $stmt->execute();
            $questionData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $questionData; 
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    

    public function NumQuestions() {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM questions");
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
