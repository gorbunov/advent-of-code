<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$questions = file_get_contents('./questions.txt');
//$questions = file_get_contents('./questions-example.txt');
$groups = explode("\n\n", $questions);

$totals = 0;
$everybodyInGroup = 0;
foreach ($groups as $group) {
    $answers = [];
    $people = explode("\n", trim($group));
    $peopleCount = count($people);
    foreach ($people as $person) {
        foreach (str_split(\trim($person)) as $letter) {
            $answers[] = $letter;
        }
    }
    $answerCounts = array_count_values($answers);
    foreach ($answerCounts as $answerCount)  {
        if ($answerCount === $peopleCount) {
            $everybodyInGroup++;
        }
    }
    $groupAnswers = count(array_unique($answers));
    $totals += $groupAnswers;
    // printf("+ %d ", $groupAnswers);
}

printf("Anyone\t\t= %d\n", $totals);
printf("Everyone\t= %d\n", $everybodyInGroup);
