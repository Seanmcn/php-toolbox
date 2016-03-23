<html>
<head>
    <title>Stack Trace Formatter</title>
</head>
<body>
<h1>Stack Trace Formatter</h1>
<?php
    $input = isset($_POST['stackTrace']) ? $_POST['stackTrace'] : FALSE;
    if (!$input) {
        ?>
        <form method="post">
            <label for="stackTrace">Stack Trace:</label> <br/>
            <textarea id="stackTrace" name="stackTrace" cols="100" rows="20"></textarea>
            <br/>
            <input type="submit">
        </form>
        <?php
    } else {
        $stacks = explode("#", $input);
        unset($stacks[0]);

        foreach ($stacks as $key => $stack) {
            $search = [
                '):'
            ];
            $replace = [
                '):</em><strong>'
            ];
            $stack = str_replace($search, $replace, $stack);
            $stack = "<em>" . $stack . "</strong><br />";

            $stacks[$key] = $stack;
        }
        echo "<pre>";
        print_r($stacks);
        echo "</pre>";
        echo "<a href=''><button>New</button></a>";
    } ?>
</body>
</html>
