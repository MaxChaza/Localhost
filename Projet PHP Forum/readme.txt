///////////////////////////////////////////////////////////////////
// 			      README				 //
// 			Secure PHP4 Forum			 //
///////////////////////////////////////////////////////////////////

//ABOUT
Website adress : http://onyx.msi.unilim.fr/~bouyat05/forum
Administrayion interface : http://onyx.msi.unilim.fr/~bouyat05/forum/admin
Author : Jordan BOUYAT (jordan.bouyat[at]etu.unilim.fr) & Maxime CHAZALVIEL (maxime.chazalviel[at].etu.unilim.fr)
Version : 1.0
Release date : 8 November 2011
University of Limoges (http://www.unilim.fr)

///////////////////////////////////////////////////////////////////
// 			 GLOBAL ARCHITECTURE			 //
///////////////////////////////////////////////////////////////////

/
│   index.php
│   
├───admin
│       index.php
│       addCategory.php
│       admin.php
│       manageRoles.php
│       manageUsers.php
│       menuAdmin.php
│       removeCategories.php
│       removeUsers.php
│       updateCategory.php
│       updateUser.php
│       footAdmin.php
│       headerAdmin.php
│
├───antibrute
│       
├───css
│       index.css
│       indexAdmin.css
│       
├───image
│       background.png
│       back_menu4.png
│       back_menu5.png
│       bann.gif
│       illus-fouine.gif
│       
├───includes
│       categoryManagement.php
│       connectionBD.php
│       messageManagement.php
│       passwordManagement.php
│       roleManagement.php
│       sessionManagement.php
│       topicManagement.php
│       userManagement.php
│       utils.php
|	config.php
│       
└───src
	foot.php
        header.php
	identification.php
        addMessage.php
        addTopic.php
        addUser.php
        deleteMessage.php
        editMessage.php
        removeTopic.php
        updateUserByUser.php
	destroySession.php

--- /INCLUDES ---
The "includes" directory contains all the manager and other important files. 
For each table, there is a manager for Create/Retrieve/Update/Delete and some usefull functions
There are managers for users, category, topic, messages, and roles. 
There is also a file to manage passwords(passwordManagement.php) (hash with salt).
There is also a config file(config.php) where you define the host, the username and the password for the database. 
You also specify the URL of the site.

--- /ANTIBRUTE ---
This folder contains one file per connected user that contains the number of connecting fails.

--- /CSS ---
This folder contains the CSS. 

-- /IMAGE --
This folder contains.

-- /SRC --
This folder contains the scripts for add a topic, add a message, identification...
Contains the header(header.php) and the foot(foot.php) of the website.
It also contains the script needed to destroy the session.

///////////////////////////////////////////////////////////////////
// 			 SECURITY ASPECTS			 //
///////////////////////////////////////////////////////////////////

//SENSIBLE ENTRY POINTS

//Countermeasures againts CSRF attacks
Differents part of the website are sensible, particularly the forms. That's the reason why we choose to use tokens in forms.
Before the form, we generate an unique token and stock it in a session variable.
On every form, we add an hidden field that contains the token just created.
When the form is posted, we test on the targeted page the token. If the token posted (in the hidden field)  is equals to the token stocked in the session variable, then it's ok.
To renforce the security of tokens, we add to them a duration of validity.
Finally, to check the logic of action, we add the HTTP_REFERER to the token. So we can verify from where come the user.
All those functionnality are implemented by createToken() and validToken() in utils.php

//Countermeasures against brute force attacks
The login page is exposed to bruteforce attacks. That's the reason why stock in the folder antibrute/ the IP adress of the user. If the user is wrong 3 times on the same username, his IP is ban for a day for the username he tried to attack.

//Countermeasures against SQL Injection and XSS
Every data are controlled before being inserted in the database by the secureString() function.
This function takes the string to secure. If the string is a number, it do the nimber converstion and return the integer value.
If the string is normal string, the string is escaped with addcslashes() and mysqli_real_escape_string().
All SQL query are made with prepared statements.
We use also use htmlentities() for printing resultsto avoid XSS attacks.

//Data verification in forms
To respect the data integrity, we verify the input data with regular expression. For example, to create a new user, the password must have major and minor letters and numbers and special caracters.
The username can't have spaces and thing like that.

//Session and cookies
The session are managed with. It's more secure than without because without, the PHPESSID is in the URL.
We can read/write the cookie only with HTTP protocol with the 'httponly' set to true when we use setcookie();.
If the server support HTTPS we also can set the 'secure' parameter  to true, in order to transmit the cookie over HTTPS.

//Password management
All passwords are hashed with SHA1 with salt (static+dynamic)

//Other
We try at the maximum to avoid using $_GET[] variables in order to use $_POST[] variables, even if $_POST[] variables are not totally safe.
