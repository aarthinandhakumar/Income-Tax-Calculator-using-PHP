    <?php

    function incomeTaxSingle($taxableIncome) { // Function for incomeTaxSingle
        $incTax = 0.0;
        if ($taxableIncome <= 9700) {
            $incTax = $taxableIncome * 0.10;
        } elseif ($taxableIncome <= 39475) {
            $incTax = 970 + (($taxableIncome - 9700) * 0.12);
        } elseif ($taxableIncome <= 84200) {
            $incTax = 4543 + (($taxableIncome - 39475) * 0.22);
        } elseif ($taxableIncome <= 160725) {
            $incTax = 14382 + (($taxableIncome - 84200) * 0.24);
        } elseif ($taxableIncome <= 204100) {
            $incTax = 32748 + (($taxableIncome - 160725) * 0.32);
        } elseif ($taxableIncome <= 510300) {
            $incTax = 46628 + (($taxableIncome - 204100) * 0.35);
        } else {
            $incTax = 153798 + (($taxableIncome - 510300) * 0.37);
        }    
        return $incTax;
    }

    function incomeTaxMarriedJointly($taxableIncome) { // Function for incomeTaxMarriedJointly
        $incTax = 0.0;
        if ($taxableIncome <= 19400) {
            $incTax = $taxableIncome * 0.10;
        } elseif ($taxableIncome <= 78950) {
            $incTax = 1940 + (($taxableIncome - 19400) * 0.12);
        } elseif ($taxableIncome <= 168400) {
            $incTax = 9086 + (($taxableIncome - 78950) * 0.22);
        } elseif ($taxableIncome <= 321450) {
            $incTax = 28765 + (($taxableIncome - 168400) * 0.24);
        } elseif ($taxableIncome <= 408200) {
            $incTax = 65497 + (($taxableIncome - 321450) * 0.32);
        } elseif ($taxableIncome <= 612350) {
            $incTax = 93257 + (($taxableIncome - 408200) * 0.35);
        } else {
            $incTax = 164709 + (($taxableIncome - 612350) * 0.37);
        }    
        return $incTax;
    }

    function incomeTaxMarriedSeparately($taxableIncome) { // Function for incomeTaxMarriedSeparately
        $incTax = 0.0;
        if ($taxableIncome <= 9700) {
            $incTax = $taxableIncome * 0.10;
        } elseif ($taxableIncome <= 39475) {
            $incTax = 970 + (($taxableIncome - 9700) * 0.12);
        } elseif ($taxableIncome <= 84200) {
            $incTax = 4543 + (($taxableIncome - 39475) * 0.22);
        } elseif ($taxableIncome <= 160725) {
            $incTax = 14382.50 + (($taxableIncome - 84200) * 0.24);
        } elseif ($taxableIncome <= 204100) {
            $incTax = 32748.50 + (($taxableIncome - 160725) * 0.32);
        } elseif ($taxableIncome <= 306175) {
            $incTax = 46628.50 + (($taxableIncome - 204100) * 0.35);
        } else {
            $incTax = 82354.75 + (($taxableIncome - 306175) * 0.37);
        }    
        return $incTax;
    }

    function incomeTaxHeadOfHousehold($taxableIncome) { // Function for incomeTaxHeadOfHousehold
        $incTax = 0.0;
        if ($taxableIncome <= 13850) {
            $incTax = $taxableIncome * 0.10;
        } elseif ($taxableIncome <= 52850) {
            $incTax = 1385 + (($taxableIncome - 13850) * 0.12);
        } elseif ($taxableIncome <= 84200) {
            $incTax = 6065 + (($taxableIncome - 52850) * 0.22);
        } elseif ($taxableIncome <= 160700) {
            $incTax = 12962 + (($taxableIncome - 84200) * 0.24);
        } elseif ($taxableIncome <= 204100) {
            $incTax = 31322 + (($taxableIncome - 160700) * 0.32);
        } elseif ($taxableIncome <= 510300) {
            $incTax = 45210 + (($taxableIncome - 204100) * 0.35);
        } else {
            $incTax = 152380 + (($taxableIncome - 510300) * 0.37);
        }    
        return $incTax;
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>HW4 Part1 - Aarthi Nandhakumar</title> <!-- Title -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <style>
            .tax-table th {
                background-color: #F0F0F0; /* Set column heading color */
            }
            .tax-table {
                max-width: 350px; /* Set width */
            }
        </style>
    </head>
    <body>

    <div class="container">

        <h3><b>Income Tax Calculator</b></h3>

        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="netIncome"><b>Your Net Income:</b></label>
                <div class="col-sm-10">
                    <input type="number" step="any" name="netIncome" placeholder="Taxable Income" required autofocus>
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['netIncome'])) {
            // Retrieve the net income from the POST data
            $netIncome = floatval($_POST['netIncome']);

            // Calculate taxes
            $taxSingle = incomeTaxSingle($netIncome);
            $taxMarriedJointly = incomeTaxMarriedJointly($netIncome);
            $taxMarriedSeparately = incomeTaxMarriedSeparately($netIncome);
            $taxHeadOfHousehold = incomeTaxHeadOfHousehold($netIncome);

            // Display results
            echo "With a net taxable income of $ " . number_format($netIncome, 2);
            echo "<br><br>";
            echo "<table class='table table-bordered tax-table'>";
            echo "<thead><tr><th>Status</th><th>Tax</th></tr></thead>";
            echo "<tbody>";
            echo "<tr><td>Single</td><td>$" . number_format($taxSingle, 2) . "</td></tr>";
            echo "<tr><td>Married Filing Jointly</td><td>$" . number_format($taxMarriedJointly, 2) . "</td></tr>";
            echo "<tr><td>Married Filing Separately</td><td>$" . number_format($taxMarriedSeparately, 2) . "</td></tr>";
            echo "<tr><td>Head of Household</td><td>$" . number_format($taxHeadOfHousehold, 2) . "</td></tr>";
            echo "</tbody></table>";
        }
        ?>

    </div>

    </body>
    </html>