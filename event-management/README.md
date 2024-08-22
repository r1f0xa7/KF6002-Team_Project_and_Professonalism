# Rose Foundation Event Management System

## Overview
This is a comprehensive event management system for the Rose Foundation NGO, aimed at facilitating cervical cancer screening events for women in Malaysia. It includes user registration, event management, a community forum, and more.

## Features
- User Registration and Login
- Event Creation, Listing, and Management
- Community Forum with Posts and Comments
- Calendar Integration for Event Dates
- Responsive Design with Light/Dark Mode
- Security Features including Password Hashing and Session Management

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/rifat/event-management.git







## Project Structure:

event_management:.
¦   .gitignore
¦   composer.json
¦   output.txt
¦   package.json
¦   README.md
¦   sql
¦   
+---assets
¦   +---css
¦   ¦       styles.css
¦   ¦       
¦   +---fonts
¦   +---images
¦   ¦       home_page_photo.jpg
¦   ¦       logo.png
¦   ¦       Rose_Foundation_Logo.jpeg
¦   ¦       
¦   +---js
¦           script.js
¦           
+---config
¦       config.php
¦       database.php
¦       functions.php
¦       
+---logs
¦       access.log
¦       error.log
¦       
+---Md_Rifat
¦   ¦   404.php
¦   ¦   about.php
¦   ¦   calendar.php
¦   ¦   dashboard.php
¦   ¦   event_details.php
¦   ¦   event_list.php
¦   ¦   home.php
¦   ¦   privacy_policy.php
¦   ¦   terms_of_service.php
¦   ¦   
¦   +---includes
¦   ¦   ¦   footer.php
¦   ¦   ¦   header.php
¦   ¦   ¦   sidebar.php
¦   ¦   ¦   
¦   ¦   +---modals
¦   ¦           login_modal.php
¦   ¦           
¦   +---users
+---Member_2
¦   ¦   auth_controller.php
¦   ¦   edit_profile.php
¦   ¦   login.php
¦   ¦   profile.php
¦   ¦   register.php
¦   ¦   user_controller.php
¦   ¦   
¦   +---auth
¦           forgot_password.php
¦           reset_password.php
¦           
+---Member_3
¦       create_post.php
¦       forum_controller.php
¦       forum_list.php
¦       forum_post.php
¦       
+---Member_4
¦       Attendance.php
¦       attendence_controller.php
¦       
+---Member_5
¦       create_event.php
¦       edit_event.php
¦       event_controller.php
¦       
+---models
¦       Event.php
¦       Forum.php
¦       User.php
¦       
+---public
¦   ¦   .htaccess
¦   ¦   index.php
¦   ¦   logout.php
¦   ¦   
¦   +---assets
+---sessions
