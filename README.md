
# RentorLend - car renting website

This project allows users to rent a car and list their cars for rent. For more functionalities, check out the 'Main Functionalities' section below.  

## Main functionalities and technical details

- Adding, deleting, editing cars: authenticated users can add a new car listing, then edit and delete it.

- Reserving:
    - Users can reserve a specified car, using a simple form with a calendar that filters out days that the car is already reserved on.
    - Users can easily manage reservations with two tables - one is showing reservations of their listed cars, and the other one is showing reservations that they have made. Every reservation have its own detail page accessible for both reserving user and car owner.

- Searching:
    - Users can use a quick search feature using AJAX, on the homepage. It checks car's make, model, year of production and fuel type, and returns matching listings.
    - Users can use an advanced search feature where they can search for a specific car using a form. They can specify i.a. make, type, location, fuel type, but also specific time period that the car is avalable to rent.

- Comments, reviews and rates:
    - Users can post a review of the car. Review contains a rate (from 1 to 5 stars) and an optional comment. All reviews are public and visible at the bottom of the car details page - in the comments section. Additionally, if the car has been reviewed, the average rate is visible on the listing card.
    - Users can rate other users on a scale of 1 to 5 stars. The average rating is visible next to the user info section of the car details page.

- Setting currency: users can change their preffered currency - PLN, US Dollar or Euro. The base currency is PLN, chosen currency and exchange rate is stored in session. Current exchange rate is taken from [NBP API](http://api.nbp.pl/).

- Notifications: car owners receive notification every time their car gets reserved. Red dot appears on the 'Manage reservations' tab, and new reservations are marked with label on the reservations table.

### Tech stack

**Backend:**  
Server: Apache  
Database: MariaDB  
Framework: Laravel 10 w/ PHP 8.1  

**Frontend:**  
JS w/ jQuery  
Tailwind  
SCSS

## Local setup

### Using docker (recommended)
Visit https://github.com/jglad01/rentorlend-docker-wrapper and follow the setup instructions.

### Using xampp
> [!IMPORTANT]
> Using xampp for setting up this project, may not work as expected. Apache/PHP versions and settings can make a huge difference on how the project works. If you want to continue using xampp, make sure your .htaccess and php.ini are similar.

1. Open xampp/htdocs in your terminal  
2. Clone the repo inside ```git clone https://github.com/jglad01/rentorlend.git .```
3. Install all composer dependencies ```composer install```
4. Changing the document root directory will most likely be needed. See how to do this [here](https://stackoverflow.com/a/18903044). Change it to the *public* directory.

## Next features 
- Email notifications
- Specifying days that car is available for rent (as a car owner)
- Cancelling reservations, both as car owner and reserving user.

