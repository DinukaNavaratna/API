# Simple Python REST API for a website in PHP, JS & etc.

This is a simple web application and a Python API with some simple features such as creating & updating user accounts for citizens, approving/disapproving accounts by admins, complaints chat option & etc..<br>
Please note that this application was completed within 48 hrs maximum, according to the requirements I was given. So, the application can be improved alot more and you are welcome to make improvements and create a PR.

## Testing
1. Pull the code
2. Create Python virtual environement and move the Python code (in 'API' directory) inside the virtual environement.
3. Install the required packages & libraries using 'pip install -r requirements.txt' (Note that you need to have pip-tools installed)
4. Update the .env values. I haven't removed the .env file because I only used localhost for the work.
5. Run 'python app.py' to switch on the server.
6. Send a GET request to /create_db endpoint to create the database & it's children.
7. Open the index.php file in 'Web' directory through a web server such as XAMPP.


## Default user credentials
1. Officer (admin)
- Email: officer1@gmail.com
- Password: 123

2. Company employee
- Email: staff1@gmail.com
- Password: 123

3. Citizen (normal user)
- Register an account through the web application.


## Features
### Citizen (normal user)
1. User registration, login & signout
2. My Profile (Profile DP & Documents on the bottom are dummy & hardcoded)
3. Edit profile
4. Make a Complaint (New complaints, reply to previous complaints listed in my profile)


### Officers (admin user)
1. Login & signout
2. Show all registered users
3. View each user's profile (Details & documents)
4. Approve/ disapprove user profile
5. Reply to complaints listed under the user profile


### Companies (view only user)
1. User registration, login & signout
2. Show all registered users
3. View each user's profile (Details & documents)
4. View the complaints of each user


## What needs to be improved
1. Dashboard is all hardcoded
2. User profile DP & documents on the bottom of my profile hardcoded
3. Registration process for admins
4. Show all compliants page for admins
5. In company staff login, all the complaint messages are being shown in one color without differentiating them like in user & admin login, using colors (gray - user, pink - officer) 

