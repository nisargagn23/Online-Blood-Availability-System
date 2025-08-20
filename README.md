Online Blood Availability System

The **Online Blood Availability System** is a web-based platform designed to help users quickly check the availability of different blood groups in nearby hospitals.
Hospitals can manage their blood stock (insert, update, delete records), while users can search for blood packs by specifying the blood group and the required quantity.

This project demonstrates how technology can assist in healthcare by making life-saving resources more accessible, transparent, and efficient.

Features
* Search availability of blood packs by group and quantity
* Hospital management (add, update, delete records)
* Displays hospital name with available stock
* Simple and user-friendly interface

Tech Stack
* Frontend: HTML, CSS
* Backend: PHP
* Database: MySQL (via phpMyAdmin in XAMPP)
* Server: XAMPP

How to Run Locally:
1. Install **XAMPP** on your system
2. Clone the repository.
3. Move the project folder into the `htdocs` directory of XAMPP
4. Start Apache and MySQL from the XAMPP control panel
5. Import the SQL file (provided in `/database` folder) into phpMyAdmin
6. Open your browser and go to:
   http://localhost/Online-Blood-Availability-System

Future Enhancement:
* Implement user authentication for hospitals and donors
* Add an online blood request and donor registration feature
* Provide notifications when stock is low
* Deploy on a cloud server for public access.
