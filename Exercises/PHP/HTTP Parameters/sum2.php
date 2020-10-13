<?php
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];
    $sum = $num1 + $num2;
?>

<!DOCTYPE html>

<html lang="en-US">
    <head>
        <title>Sum - Result</title>
        <meta charset="UTF-8">
    </head>

    <body>
        <header>
            <h1>Sum Result:</h1>
        </header>

        <main>
            <h2><?php echo "$num1 + $num2 = $sum" ?></h2>
            <div>
                <a href="form2.html">Back</a>
            </div>
        </main>
    </body>
</html>