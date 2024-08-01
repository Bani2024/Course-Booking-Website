

-+-+-+-+-+-+-+-+- read before working on the project -+-+-+-+-+-+-+-+-


/////// setup workstation: ///////


--- 1st step ---
copy & paste this whole file(course_booking_website) inside :- c:\xampp\htdocs\ here!!!!


--- 2nd step ---
then open this link :- http://localhost/phpmyadmin


--- 3rd step ---
and create a new database name it(course_db) 


--- 4th step ---
and on the top middle side u will find a option import click and upload this (course_db.sql)file present insde :- course_booking_website\database\ course_db.sql !!!!!



/////// database connected ///////


now check by opening below 1st link (you will see a message [Hello, World!] ) means connection working

for opening site >>>> http://localhost/course_booking_website/

for opening admin_site >>>> http://localhost/course_booking_website/admin

for opening specific page(.php) >>>> http://localhost/course_booking_website/(filename).php



--------------------------------------------------------------



/////// File Structure: for front end ///////

index.php (Hero Area): satya snehal   <<<<< assigned person


login/logout.php: rishita   <<<<< assigned person


register.php (Signup): shreyashi   <<<<< assigned person


footer.php: shreyashi rishita   <<<<< assigned person


payment.php: snehal   <<<<< assigned person


--------------------------------------
style.css: write all css here

scripts.css: write javascript
--------------------------------------

assets/images/(image_name).jpg : for images ( snipet for connecting with asstes folder )
assets/icons/(icon_name).svg : for icons ( snipet for connecting with asstes folder ) 


--------------------------------------------------------------


/////// Admin Panel Structure: /////// satya sarbani snehal   <<<<< assigned team

index.php (Admin Panel - Intro): 


course_manage.php (Admin Panel - Course Manager):


site_settings.php (Admin Panel - Site Settings):


admin_login.php (Admin Panel - User Login):

--------------------------------------
style.css: write all css here

scripts.css: write javascript
--------------------------------------

assets/images/(image_name).jpg : for images ( snipet for connecting with asstes folder )
assets/icons/(icon_name).svg : for icons ( snipet for connecting with asstes folder ) 



--------------------------------------------------------------



///////  admin_class.php (Admin Panel - Class Logic):  ///////


///////  ajax.php (Admin Panel - Ajax Logic):  ///////



--------------------------------------------------------------



/////// Tables: create new table only for your file this is example ///////

admin_login (For storing admin user information)
courses (For storing course information)
bookings (To link users with booked courses)
settings (For site settings)



--------------------------------------------------------------



/////// Connection: ///////

edit the course_db.sql file to handle database connection:

Database file Name: course_db.sql



