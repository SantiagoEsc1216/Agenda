# Agenda

<p >
  This website has the purpose of privide a simple agenda only with the minimal information of contact.
  <br>
  The users can create contacts with a name, a phone and aa email, also, the users have the possibility of add an image or use a default image.
  <br>
  After of add a contact, the user can edit or delete since the main page with the options of each contact.
</p>

## Table of Contents

- [About](#about)
- [Getting Started](#getting_started)
- [Usage](#usage)
- [Built using](#built_using)
- [Authors](#authors)

## About <a name = "about"></a>
This is my first complete web site what i do since the pyoyects of my highschool.
<br>
In this project my main purpose was learn php, i was want learn to do backend, because it was something that i hadn't the opportunity of learn in the highschool.
  <br>
Also, this project was give me the opportunity of take my first steps in bootstrap 4 and to do more use of javascript to create a more interactive interface.

## 🏁 Getting Started <a name = "getting_started"></a>

Step 1: Clone the project with the comand:

```
$ git clone https://github.com/SantiagoEsc1216/Agenda
```
Step 2: Move the project to an environment of local development

Step 3: Create the database with the name "agenda":

```
CREATE DATABASE agenda;
```
Step 4: Move the file "agenda_dump.sql" in to the folder where you have the files of local database and import the database with the command:

```
mysql -u root -p agenda < agenda_dump.sql
```
Step 5: Change the database access data in the file server_sql.php in the folder php_scripts with the parameters of the local database.

### Structure

The project "Agenda" have the following folders and files.
- css:
  - boostrap.css
  - style.css: Estilos especificos de elementos.

- Imagenes: Folder to save the images of each contact and the default image.

- js:
  - bootsrap.min.js
  - ContactOptions.js
  - jquery.min.js
  - login.js: Login error messagges.
  - popper.min.js
  - profile.js: Form handling to edit profile and validate form.
  - singup.js: Validate form of register.
  - valid_inputs.js: validate form to add a contact.

- php_scripts:
  - closeSession.php: Closse the session.
  - Contact.php: Class to handling the options of each contact, add a new contact, edit a contact and delete a contact.
  - server_sql.php: Database access data.
  - user.php: Class to handling the user options in the database, register, login and edit the user information.
  - valid_inputs.php: Functions to sanitize  and validate information from forms.

- web_sites:
  - Agenda.php: Main site to see and administrate the users contacts.
  - login.php: Site to login.
  - new_contact.php: Site to add a new contact.
  - profile.php: Site of edit user information.

- Agenda_dump.slq: Base de datos el proyecto.
- beta.txt: Registro de modificaciones de la version beta.
- package-lock.json

### Prerequisites

A development environment what allow create a localserver with support for PHP 7.2.18 y MySQL 5.7.26.

```
Softwares like wampserver and xampp give a development enviroment with this requisites.
```

## 🎈 Usage <a name = "usage"></a>

The usage of this website have purpose of be that simple of it's possible, a fast register, a fast and simple handling of contacts with just the minimus information and an extra options for handling the profiles of each user.

when the a users in to a any site in the folder web_sites and don't have a session logged, will be redirected to de page of login.

Once logged, the user can see the contacts that he add and the options of edit and delete of each contact. In the top of the website, there will be a navbar with a button to comeback to the main page, to add a contact and a menu to get in his profile options or close session.

## ⛏️ Built using <a name = "built_using"></a>

- [MySQL](https://www.mysql.com/) - Database
- [PHP](https://www.php.net/) - Backend
- [Bootstrap 4](https://getbootstrap.com/) -  CSS framework
- [JQuery](https://popper.js.org/)  - just for boostrap 4
- [popper](https://jquery.com/) - just for boostrap 4

## ✍️ Authors <a name = "authors"></a>

- [@SantiagoEsc1216](https://github.com/SantiagoEsc1216) - Idea and full development.