<?php

include_once("../config/db.php");

$dbconn = new Database();


class answer {
    private $answerId;
    private $answerText;
    private $answerCorrect;

    public function __construct($answerId, $answerText, $answerCorrect) {
        $this->answerId = $answerId;
        $this->answerText = $answerText;
        $this->answerCorrect = $answerCorrect;
    }

    public function getAnswerId() {
        return $this->answerId;
    }

    public function getAnswer() {
        return $this->answerText;
    }

    public function getCorrectAnswer() {
        return $this->answerCorrect;
    }
}

class answerDAO {
    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    function getAnswer($questionId) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM answers WHERE question_id = ?");
            $stmt->execute([$questionId]);
            $allanswers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $answers = array();
            
            foreach ($allanswers  as $answer) {
                $answers[] = new answer($answer['answer_id'], $answer['answer_text'], $answer['question_id'], $answer['isCorrect']);
            }

            return $answers;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

 public function correctAnswer($id_question, $id_answer) {
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM answers WHERE answer_id = :answer_id AND question_id = :question_id AND isCorrect = 1");
    $stmt->bindParam(':question_id', $id_question);
    $stmt->bindParam(':answer_id', $id_answer);
    $stmt->execute();

    $count = $stmt->fetchColumn();
    echo "Question ID: $id_question | Answer ID: $id_answer | Count: $count" . PHP_EOL;
    return ($count > 0);
}

}
