<?php


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
