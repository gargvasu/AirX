# AirX
AirX is an Online Flight Booking System developed as an assignment by One Direct Hiring.

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 


### Prerequisites

an Apache-MySQL-PHP environment local testing server
```
WAMP
XAMPP
```

a Web Browser
```
Google Chrome
```

a Text Editor
```
Notepad++
```
### Installing

A step by step series of examples that tell you how to get the site running on your local server

```
1. Add the folder to your C:/wamp/www/ or C:xampp/htdocs/ directory
```

```
2. Create a database with name AirX on phpmyadmin portal and import the structure using the airx.sql file
```

```
3. Configure the database in AirX\core\database\connect.php
```

```
4. Go to localhost/AirX/
```

```
5. Add flights to the database using the insert_flight.sql
```

## Screenshots

Search Page
![image](https://gargvasu.in/AirX_images/1.png)



Flights cuurently in Database
![image](https://gargvasu.in/AirX_images/7.png)



Flight List Displayed
![image](https://gargvasu.in/AirX_images/2.png)



User Login Page
![image](https://gargvasu.in/AirX_images/3.png)



Passenger Detail to be entered here for booking
![image](https://gargvasu.in/AirX_images/4.png)



Save Payment Details for fast and easy Payment process
![image](https://gargvasu.in/AirX_images/5.png)



Saved Debit/Credit Cards
![image](https://gargvasu.in/AirX_images/6.png)



# Live Demo

 [AirX](https://www.gargvasu.in/AirX)

Mail Account for account activation and password reset : AirX@gargvasu.in 
Please check your spam folder also
 
### Deployment

A step by step series of examples that tell you how to get the site running on cPanel Linux Hosting

```
1. Upload your files to your linux hosting either using ftp or manual file upload
```

```
2. Create a database with name AirX on phpmyadmin portal and import the structure using the airx.sql file. Add the database privileges to the database user for this database.
```

```
3. Configure the database in AirX\core\database\connect.php. Also, configure the include path for all the files as /home/{user_name}/public_html/AirX/path
```

```
4. Add flights to the database using the insert_flight.sql
```

```
5. Set up AirX@your_domain_name.com email account
```

