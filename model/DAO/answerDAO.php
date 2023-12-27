<?php


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