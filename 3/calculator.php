<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Урок №3</title>
</head>
<body>


<h2>Напишите программу-калькулятор
    Форма для ввода двух чисел, выбора знака операции и кнопка "равно"
    Данные пусть передаются методом GET из формы (да, можно и так!) на скрипт, который их примет и выведет выражение и его результат
    * Попробуйте улучшить программу. Пусть данные отправляются на ту же страницу на PHP, введенные числа останутся в input-ах, а результат появится после кнопки "равно"</h2>

<?php
$operationsArray = ['plus' => '+', 'minus' => '-', 'multiplication' => '*', 'division' => '/'];

function calculator($operation, $number1, $number2) {
    switch ($operation) {
        case 'plus':
            return $number1 + $number2;
            break;
        case 'minus':
            return $number1 - $number2;
            break;
        case 'multiplication':
            return $number1 * $number2;
            break;
        case 'division':
            if ($number2 == 0) {
                return 'err0';
            } else {
                return $number1 / $number2;
            }
            break;
        default:
            // Недопустимая операция
            return 'errOp';
    }
}

assert(15 === calculator('plus', 5, 10));
assert(-5 === calculator('minus', 5, 10));
assert(50 === calculator('multiplication', 5, 10));
assert(3 === calculator('division', 15, 5));
assert('err0' === calculator('division', 15, 0));
assert('err0' === calculator('division', 15, '0'));
assert('errOp' === calculator('division2', 15, 5));

if(false === isset($_GET['operation'])) {
    ?>
    <h3>Введите данные в калькулятор</h3>
    <?php
}
else {
    ?>
    <h3>Результат</h3>
    <?php
}
?>
<form method="get" action="calculator.php">
    <input type="text" name="number1" value="<?php
    if (isset($_GET['number1'])) {
        echo $_GET['number1'];
    } ?>">
    <select name="operation">
    <?php
        if (false === isset($_GET['operation'])) {
    ?>
        <option value="">
        <?php foreach ($operationsArray as $op => $opSymbol) {
        
        ?>
        <option value="<?php echo $op ?>">
        <?php echo $opSymbol;
        }
        ?>     
        </option>
        <?php 
        } else {
            foreach ($operationsArray as $op => $opSymbol) { ?>
        <option value="<?php echo $op ?>" 
        <?php
            if ($op === $_GET['operation']) {
                echo 'selected';
            }?>
            ><?php echo $opSymbol; ?></option>
        <?php 
            }
        } ?>
    </select>
    <input type="text" name="number2" value="<?php
    if (isset($_GET['number2'])) {
        echo $_GET['number2'];
    }
    ?>">
    <button type="submit">=</button>
    
    <?php
    if (isset($number1) && isset($number2) && isset($operation)) {
        echo '<b>' . calculator($operation, $number1, $number2) .'<br/>';
    }
    ?>
</form>

</body>
</html>
