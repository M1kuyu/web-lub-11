<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Таблица умножения</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Главное меню -->
    <div class="main_menu">
    <?php
        // Проверяем наличие параметра html_type в URL
        $currentHtmlType = isset($_GET['html_type']) ? $_GET['html_type'] : null; 
        $currentContent = isset($_GET['content']) ? $_GET['content'] : null;

        // Ссылка на табличную верстку
        echo '<a href="?html_type=TABLE' . ($currentContent ? '&content=' . $currentContent : '') . '"';
        // Если html_type равно 'TABLE', добавляем класс selected
        if ($currentHtmlType == 'TABLE') echo ' class="selected"';
        echo '>Табличная верстка</a> ';

        // Ссылка на блочную верстку
        echo '<a href="?html_type=DIV' . ($currentContent ? '&content=' . $currentContent : '') . '"';
        // Если html_type равно 'DIV', добавляем класс selected
        if ($currentHtmlType == 'DIV') echo ' class="selected"';
        echo '>Блочная верстка</a>';
        ?>
    </div>


    <!-- Основное меню -->
    <div class="product_menu">
        <?php
        // Ссылка для "Вся таблица умножения"
        echo '<a href="/' . ($currentHtmlType ? '?html_type=' . $currentHtmlType : '') . '"';
        if (!$currentContent) echo ' class="selected"';
        echo '>Вся таблица умножения</a>';

        for ($i = 2; $i <= 9; $i++) {
            echo '<a href="?content=' . $i . ($currentHtmlType ? '&html_type=' . $currentHtmlType : '') . '"';
            if ($currentContent == $i) echo ' class="selected"';
            echo '>Таблица умножения на ' . $i . '</a>';
        }
        ?>
    </div>

    <!-- Основная часть -->
    <div class="content">
        <?php
        function outTableForm($content = null) {
            echo '<table border="1">';
            for ($i = 1; $i <= 9; $i++) {
                echo '<tr>';
                for ($j = 2; $j <= 9; $j++) {
                    if (!$content || $j == $content) {
                        echo '<td>';
                        
                        // Выводим ссылку только для одноцифровых чисел
                        $leftLink = ($i < 10 && $i != 1) ? '<a href="?content=' . $i . '">' . $i . '</a>' : $i;
                        $rightLink = ($j < 10 && $j != 1) ? '<a href="?content=' . $j . '">' . $j . '</a>' : $j;
                        $resultLink = ($i * $j < 10) ? '<a href="?content=' . ($i * $j) . '">' . ($i * $j) . '</a>' : ($i * $j);
        
                        // Печатаем формулу
                        echo $leftLink . ' x ' . $rightLink . ' = ' . $resultLink;
                        echo '</td>';
                    }
                }
                echo '</tr>';
            }
            echo '</table>';
        }

        function outDivForm($content = null) {
    for ($i = 1; $i <= 9; $i++) {
        echo '<div class="multiplication-row">';
        for ($j = 2; $j <= 9; $j++) {
            if (!$content || $j == $content) {
                // Проверяем и создаем ссылки только для одноцифровых чисел, исключая 1
                $leftLink = ($j != 1 && $j < 10) ? '<a href="?content=' . $j . '">' . $j . '</a>' : $j;
                $rightLink = ($i != 1 && $i < 10) ? '<a href="?content=' . $i . '">' . $i . '</a>' : $i;
                $result = $j * $i;
                $resultLink = ($result < 10 && $result != 1) ? '<a href="?content=' . $result . '">' . $result . '</a>' : $result;

                // Печатаем блок с расчетом
                echo '<div class="cell">';
                echo $leftLink . ' x ' . $rightLink . ' = ' . $resultLink;
                echo '</div>';
            }
        }
        echo '</div>';
    }
}

        if ($currentHtmlType == 'DIV') {
            outDivForm($currentContent);
            
        } else {
            outTableForm($currentContent);
        }
        ?>
    </div>

    <!-- Подвал -->
    <footer>
        <?php
        date_default_timezone_set('Europe/Moscow');

        echo 'Тип верстки: ' . ($currentHtmlType == 'DIV' ? 'Блочная' : 'Табличная') . '<br>';
        echo 'Таблица умножения: ' . ($currentContent ? 'на ' . $currentContent : 'полная') . '<br>';
        echo 'Дата и время: ' . date('d.m.Y H:i:s');
        ?>
    </footer>
</body>
</html>
