  <?php

  define('TAX_RATES',
    array(
      'Single' => array(
        'Rates' => array(10,12,22,24,32,35,37),
        'Ranges' => array(0,9700,39475,84200,160725,204100,510300),
        'MinTax' => array(0, 970,4543,14382,32748,46628,153798)
      ),
      'Married_Jointly' => array(
        'Rates' => array(10,12,22,24,32,35,37),
        'Ranges' => array(0,19400,78950,168400,321450,408200,612350),
        'MinTax' => array(0, 1940,9086,28765,65497,93257,164709)
      ),
      'Married_Separately' => array(
        'Rates' => array(10,12,22,24,32,35,37),
        'Ranges' => array(0,9700,39475,84200,160725,204100,306175),
        'MinTax' => array(0, 970,4543,14382.50,32748.50,46628.50,82354.75)
      ),
      'Head_Household' => array(
        'Rates' => array(10,12,22,24,32,35,37),
        'Ranges' => array(0,13850,52850,84200,160700,204100,510300),
        'MinTax' => array(0, 1385,6065,12962,31322,45210,152380)
      )
    )
  );

  function incomeTax($taxableIncome, $status) {
    $incTax = 0.0;

    // Get the tax data for the given status
    $rates = TAX_RATES[$status]['Rates'];
    $ranges = TAX_RATES[$status]['Ranges'];
    $minTax = TAX_RATES[$status]['MinTax'];

    // Determine the index for the income range
    for ($i = 0; $i < count($ranges) - 1; $i++) {
        if ($taxableIncome <= $ranges[$i + 1]) {
            // Calculate tax based on the rate and range
            $incTax = $minTax[$i] + (($taxableIncome - $ranges[$i]) * ($rates[$i] / 100));
            break;
        }
    }

    // Handle income above the highest range
    if ($taxableIncome > end($ranges)) {
        $lastIndex = count($ranges) - 1;
        $incTax = $minTax[$lastIndex] + (($taxableIncome - $ranges[$lastIndex]) * ($rates[$lastIndex] / 100));
    }

    return $incTax;
}

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>HW4 Part2 - Aarthi Nandhakumar</title>
      <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
      <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
      <style>
          .tax-table {
              margin-bottom: 30px;
              width: 500px; /* Set consistent width */
          }
          .tax-table th, .tax-table td {
              text-align: left;
              padding: 8px;
          }
          .tax-table th {
              background-color: #F0F0F0; /* Set column heading color */
          }
          .tax-table td {
              border-top: 1px solid #ddd;
          }
      </style>
  </head>

  <body>

  <div class="container">

      <h3>Income Tax Calculator</h3>

      <form class="form-horizontal" method="post">
        <div class="form-group">
          <label class="control-label col-sm-2">Enter Net Income:</label>
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
              $netIncome = floatval($_POST['netIncome']);

              // Calculate taxes
              $taxSingle = incomeTax($netIncome, 'Single');
              $taxMarriedJointly = incomeTax($netIncome, 'Married_Jointly');
              $taxMarriedSeparately = incomeTax($netIncome, 'Married_Separately');
              $taxHeadOfHousehold = incomeTax($netIncome, 'Head_Household');

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

      <h3>2019 Tax Tables</h3>

      <?php
      foreach (TAX_RATES as $status => $data) {
          echo "<h4>" . preg_replace('/_([A-Z])/', '_$1', $status) . "</h4>";
          echo "<table class='tax-table table table-bordered'>";
          echo "<tr><th>Taxable Income</th><th>Tax Rate</th></tr>";

          $rates = $data['Rates'];
          $ranges = $data['Ranges'];
          $minTax = $data['MinTax'];

          // Output the ranges and rates
          for ($i = 0; $i < count($ranges) - 1; $i++) {
              if ($i == 0) {
                  // First row
                  echo "<tr><td>$" . number_format($ranges[$i]) . " - $" . number_format($ranges[$i + 1]) . "</td><td>" . $rates[$i] . "%</td></tr>";
              } else {
                  // Middle rows
                  echo "<tr><td>$" . number_format($ranges[$i] + 1) . " - $" . number_format($ranges[$i + 1]) . "</td><td>$" . number_format($minTax[$i], 2) . " plus " . $rates[$i] . "% of the amount over $" . number_format($ranges[$i]) . "</td></tr>";
              }
          }

          // Last row
          $lastIndex = count($ranges) - 1;
          echo "<tr><td>$" . number_format($ranges[$lastIndex] + 1) . " or more</td><td>$" . number_format($minTax[$lastIndex], 2) . " plus " . $rates[$lastIndex] . "% of the amount over $" . number_format($ranges[$lastIndex]) . "</td></tr>";

          echo "</table>";
      }
      ?>

  </div>

  </body>
  </html>