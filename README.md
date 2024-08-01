# Income Tax Calculator

## Overview
This project involves creating a web application to calculate and display income tax based on user input. The application is developed in an effort to focus on conditionals, arrays, and loops in PHP.

## Technologies Used
- PHP
- HTML
- CSS (Bootstrap for styling)
- Apache Server (for running PHP scripts)

## Prerequisites
Before you begin, ensure you have the following installed:
- [XAMPP](https://www.apachefriends.org/index.html), [WAMP](http://www.wampserver.com/en/), or [MAMP](https://www.mamp.info/en/) (for running a local Apache server with PHP support)
- A web browser (e.g., Chrome, Firefox)

## Installation Steps
1. **Download and Install XAMPP/WAMP/MAMP:**
   - Download XAMPP from [here](https://www.apachefriends.org/index.html) or choose WAMP/MAMP as per your OS.
   - Install the server environment by following the installation instructions on the website.

2. **Setup the Project Folder:**
   - Create and name the project folder.
   - Download or clone the project repository.

3. **Move the Project Folder to the Server Directory:**
   - For XAMPP, move the folder to the `htdocs` directory.
   - For WAMP, move the folder to the `www` directory.

4. **Start the Server:**
   - Open the XAMPP/WAMP/MAMP control panel.
   - Start the Apache server.

6. **Access the Application in a Web Browser:**
   - Open a web browser and navigate to `http://localhost/*project folder name/income_tax_v1.php` or income_tax_v2.php
  
## Part 1 – Conditionals
In this part, we develop a PHP script, `income_tax_v1.php`, that calculates the income tax based on the user’s gross annual income. The script includes:
1. A form to collect gross annual income.
2. Functions to compute tax for different filing statuses:
    - `incomeTaxSingle($income)`
    - `incomeTaxMarriedJointly($income)`
    - `incomeTaxMarriedSeparately($income)`
    - `incomeTaxHeadOfHousehold($income)`
3. Conditional statements (`if`, `elseif`) to determine the tax based on income brackets.
4. Display of results using Bootstrap for styling.


## Part 2 – Arrays and Loops
In this part, we refactor the script to use arrays and loops for better code organization and flexibility. The script, `income_tax_v2.php`, includes:
1. Definition of tax rates using PHP arrays.
2. A function `incomeTax($income, $status)` to calculate the tax based on income and filing status.
3. Use of loops and conditionals to determine the correct tax bracket and compute the tax.
4. Dynamic display of tax tables based on the defined arrays.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE.txt) file for details.
