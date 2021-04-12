<?php
/*
 * Gelöste Katas: 
 * Roman: https://ccd-school.de/coding-dojo/function-katas/from-roman-numerals/
 * Happy: https://ccd-school.de/coding-dojo/function-katas/froehliche-zahlen/
 * RotatingEncryption: https://ccd-school.de/coding-dojo/function-katas/rot-13/
 * Bowling: https://ccd-school.de/coding-dojo/class-katas/bowling/
 * BoxPlot: https://ccd-school.de/coding-dojo/class-katas/box-plot/
 */
spl_autoload_register(function ($class) {
    include "src" . DIRECTORY_SEPARATOR . str_replace('\\', '/', $class) . ".php";
});
?>

<html>
    <body>
        <h1>
            Dies ist ein Test. Herzlich willkommen auf meiner Seite.
        </h1>
        <div>
            <?php
            include ("src/views/BoxPlot/BoxPlotForm.html");
            $boxPlot = new \BoxPlot\BoxPlotController();
            $boxPlot->createBoxPlot('src/BoxPlot/images/file.png', $_POST);
            
            ?>
            <img src="src/BoxPlot/images/file.png" />
        </div>
    </body>
</html>