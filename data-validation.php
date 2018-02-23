<?php
/*
 * Kianna Dyck
 * 02/21/2018
 * Data Validation
 */

/**
 * This method takes a String representing a part number and returns
 * true if it is valid and false otherwise.
 * @param $str Represents a part number
 * @return bool
 */
function validPart($str)
{
    // format is CC-WW-PPPP
    // leading and trailing spaces irrelevant, case is irrelevant
    // CC must be either HW, SG, or AP
    // WW must be two digits and numeric
    // PPPP is a four-character alphanumeric code representing the part number

    //remove extra white space
    $input = trim($str);

    // split String so different parts of the Part number can be analyzed
    $parts = explode('-', $input);
    $isValid = true;

    $categories = array('HW', 'SG', 'AP');

    // convert category to uppercase for case insensitive comparison
    $category = strtoupper($parts[0]);

    // check that category is one of the three accepted (HW, SG, or AP)
    if(!in_array($category, $categories)) {
        $isValid = false;
    }

    // check that middle part is two char long and is numeric
    if(strlen($parts[1]) != 2 || !ctype_digit($parts[1])) {
        $isValid = false;
    }

    // check final part of part number is four char long and is alphanumeric
    if(strlen($parts[2]) != 4 || !ctype_alnum($parts[2])) {
        $isValid = false;
    }

    if($isValid)
    {
        return true;
    }

    return false;

}

/**
 * This method takes a String representing a part number and returns
 * true if it is valid and false otherwise using a regex pattern.
 * @param $str Represents a part number
 * @return bool
 */
function validPartRx($str) {
    // trim white space
    $string = trim($str);

    // compare regex pattern with given String
    $regexp = '/^(HW)?(SG)?(AP)?-\d{2}-\w{4}$/i';
    return preg_match($regexp, $string);
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Validation Practice</title>
</head>
<body>
<h2>Data Validation</h2>
<?php

    echo "<h4>Part 1: Testing Data Validation using php function</h4>";
    $partNumbers = array("AP-12-3507", "  ap-99-X109  ", "SG-05-ab20",
        "ab-22-N250", "SG-xx-N250", "SG-22-250", "SG-22-250*");

    foreach ($partNumbers as $part) {
        if (validPart($part)) {
            echo "<p>$part is valid.</p>";
        } else {
            echo "<p>$part is not valid.</p>";
        }
    }

    echo "<h4>Part 2: Testing Data Validation using regex function</h4>";
    foreach ($partNumbers as $part) {
        if (validPartRx($part)) {
            echo "<p>$part is valid.</p>";
        } else {
            echo "<p>$part is not valid.</p>";
        }
    }


?>
</body>

</html>