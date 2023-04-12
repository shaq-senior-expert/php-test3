# PHP Assessment Test

### Problem 3:

## Basic Steps of implementation

1. Database Setup:

Create a database with a table to store user records. <br>
The user record table should have columns for gender, name (title, first, last), location (street, city, state, country, postcode), email, phone, and picture (large). <br>
Store the fetched user records from the API into the database table. <br>

2. Frontend Setup:

Create a homepage that displays the user records from the database. <br>
Implement lazy loading to display only 5 records at a time and fetch the next 5 records as the user scrolls down. <br>
Add an [Edit] button to each record which when clicked will display a form to edit the user data. <br>
Implement mobile responsiveness using Bootstrap. <br>

3. Backend Setup:

Create a backend API endpoint to fetch user records from the database. <br>
Create a backend API endpoint to edit user records in the database. <br>
Create a backend API endpoint to export user records to a CSV file. <br>
Use a queue system to handle file generation in the background. <br>

4. Integration:

Connect the frontend to the backend API endpoints to fetch, edit, and export user records. <br>
Test the application and ensure all functionalities are working as expected. <br>

## Codes

* Database: To store the user records, it creates a MySQL database with a table called users that has the following columns:

id (auto-incremented integer, primary key)
title (varchar)
first_name (varchar)
last_name (varchar)
street (varchar)
city (varchar)
state (varchar)
country (varchar)
postcode (varchar)
email (varchar)
phone (varchar)
picture (varchar)

1. index.php

In this code, it imported all PHP codes.

2. fetch-users.php

In this code, it used PHP's file_get_contents() function to fetch user records from the API endpoint. 
It decodes the JSON response and insert the relevant data into the users table in the database.

3. display-users.php

In this code, it retrieves the first five user records from the users table and displays them on the home page. 
It also implemented lazy loading to fetch the next five records as the user scrolls down the page.

4. edit-users.php

In this code, it retrieves the user record to be edited from the users table and displays it in a form. 
The user is able to edit the relevant fields and submit the form to update the record in the database.

5. expert-users.php

In this code, it retrieves all the user records from the users table and exports them to a CSV file using PHP's built-in fputcsv() function. 
It uses a job queue system like RabbitMQ or Beanstalkd to handle the export process asynchronously.



