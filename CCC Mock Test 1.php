<?php
session_start();

// Define the correct answers for each question
$correctAnswers = ['a', 'd', 'd', 'c', 'b'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize score
    $score = 0;

    // Check each question's answer
    for ($i = 1; $i <= 5; $i++) {
        $userAnswer = $_POST['q'.$i];
        if ($userAnswer === $correctAnswers[$i - 1]) {
            $score++;
        }
    }

    // Store the score in session
    $_SESSION['score'] = $score;

    // Redirect to the results page
    header("Location: results.php");
    exit();
}
?>



