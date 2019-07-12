<?php
use lib\MathEval;

$result = '';
$input = '';
if (isset($_POST['expression'])) {
    $input = 'Входящее выражение: '.strip_tags($_POST['expression']);
    $mathEval = new MathEval;
    $mathEvalResult = json_decode($mathEval->getExpressionEval($_POST['expression']));
    $result = $mathEvalResult->error ? 'Ошибка: '.$mathEvalResult->error : 'Результат: '.$mathEvalResult->result;
}

// autoload function
function __autoload($class) {
    $class = str_replace('\\', '/', $class) . '.php';
	require_once($class);
}
?>

<html>
    <form method="post">
    <div>
        Введите математическое выражение
    </div>
    <div>
        <input type="text" name="expression">
    </div>
    <div>
        <input type="submit" name="Рассчитать">
    </div>
    </form>
    <div>
        <?= $input ?>
    </div>
    <div>
        <?= $result ?>
    </div>
</html>