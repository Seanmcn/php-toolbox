<?php
    // How many tests to run
    $tests = 10;

    // How many times to call the function within each test.
    $functionCallsPerTest = 10000;

    // Fill in values to test here
    $values = [
        "Pork loin pork chop frankfurter",
        "Pork loin pork chop frankfurter kevin tongue, hamburger beef filet mignon cupim tenderloin flank capicola. Strip steak meatball short loin spare ribs venison beef ribs. Leberkas kielbasa drumstick ham hock, beef ribs sausage prosciutto shankle doner filet mignon meatloaf venison pork belly. Doner fatback tail swine bresaola, sirloin frankfurter pork loin beef ribs. Tri-tip short ribs frankfurter meatloaf biltong. Ham bresaola beef short ribs porchetta pancetta pig venison meatball. Jerky ball tip chuck shank swine ribeye porchetta.",
    ];

    // Replace body of functionA & functionB below with what you are benchmarking. (EG: strlen v mb_strlen )
    function functionA($x)
    {
        strlen($x);
    }

    function functionB($x)
    {
        mb_strlen($x);
    }

    $t = 0;

    while ($t < $tests) {
        // Generate an array of keys so both functions test against the same random order of keys:
        $keys = [];
        $i = 0;
        while ($i <= $functionCallsPerTest) {
            $keys[] = array_rand($values, 1);
            $i++;
        }

        // Test the first function
        $aTime = 0;
        $aStart = microtime(TRUE);
        foreach ($keys as $key) {
            functionA($values[$key]);

        }
        $aEnd = microtime(TRUE);

        // Test the second function
        $bTime = 0;
        $bStart = microtime(TRUE);
        foreach ($keys as $key) {
            functionB($values[$key]);
            $i++;
        }
        $bEnd = microtime(TRUE);

        $aTook = $aEnd - $aStart;
        $bTook = $bEnd - $bStart;

        // Output results
        echo "functionA took: $aTook \n";
        echo "functionB took: $bTook \n";

        if ($aTook == $bTook) {
            echo "Both functions are the exact same.. #strange \n";
        } elseif ($aTook < $bTook) {
            $faster = $bTook / $aTook;
            echo "functionA was $faster times faster \n";
        } else {
            $faster = $aTook / $bTook;
            echo "functionB was faster \n";
        }

        echo "____________________________\n\n";

        $t++;
    }