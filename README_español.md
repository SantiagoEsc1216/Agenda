# Agenda

<p >
  Está pagina web tiene como objetivo proporcionar una agenda simple con los datos minimos de contacto.
    <br>
  Los usuarios pueden crear contactos agregando su nombre, telefono y correo electronico, ademas pueden agregar una imagen de manera opcional.<br>
  Despues podran eliminar o editar sus contactos desde la pagina principal con las opciones de cada contacto.
</p>

## 📝 Tabla de contenidos

- [Acerca de](#about)
- [Empezando](#getting_started)
- [Uso](#usage)
- [Construido con](#built_using)
- [Autores](#authors)

## 🧐 Acerca de <a name = "about"></a>

Está es la primera pagina web completa que hago desde los proyectos y trabajos de mi escuela.
En estre proyecto me centré en aprender principalmente php, ya que quería aprender a hacer backend, que es algo que no tuve la oportunidad de aprender en la escuela.
  <br>
Además este proyecto me dio la oportunidad de dar mis primeros pasos con bootstrap 4 y hacer mas uso de javascript para crear una interfaz mas interactiva.

## 🏁 Empezando <a name = "getting_started"></a>

Paso 1: clonar el proyecto con el comando:

```
$ git clone https://github.com/SantiagoEsc1216/Agenda

```
Paso 2: Mover el proyecto a un entorno de desarrollo local como wampserver o xampp:

paso 3: crear una base de datos con el nombre "agenda"
```
CREATE DATABASE agenda;

```
paso 4: Mover el archivo "agenda_dump.sql" a la carpeta donde esten los archivos de la base de datos local e importar la base de datos con el comando
```
mysql -u root -p agenda < agenda_dump.sql

```

paso 5: Cambiar los parametros de la base de datos local en el archivo "server_sql.php" en la carpeta php_sciprts para tener acceso a la base de datos.

### Estructura

Dentro del proyecto Agenda se encuentran las siguientes carpetas y archivos:
- css:
  - boostrap.css
  - style.css: Estilos especificos de elementos.

- Imagenes: Carpeta para guardar las imagenes de cada contacto y la imagen default.

- js:
  - bootsrap.min.js
  - ContactOptions.js: Opciones de contacto.
  - jquery.min.jsFu
  - login.js: Mensajes de error.
  - popper.min.js
  - profile.js: Manejo de formulario para editar pefil y validación de campos.
  - singup.js: Validaciión de campos en registro.
  - valid_inputs.js: Validación de campos en Agregar contacto.

- php_scripts:
  - closeSession.php: Se encarga de cerrar la sesión.
  - Contact.php: Clase para manejar las opciones de cada contacto en la base de datos, añadir, editar y eliminar.
  - server_sql.php: Datos para conectarse a la base de datos.
  - user.php: Clase para manejar las opciones de usuario en la base de datos, registrarse, iniciar sesion y editar datos.
  - valid_inputs.php: Funciones para limpiar y validar campos.

- web_sites:
  - Agenda.php: Sitio principal para ver y administrar contactos.
  - login.php: Sitio para iniciar sesión.
  - new_contact.php: Sitio para agregar un nuevo contacto.
  - profile.php: Sitio para con opciones de configuración del perfil de cada usuario.

- Agenda_dump.slq: Base de datos el proyecto.
- beta.txt: Registro de modificaciones de la version beta.
- package-lock.json


### Prerequisitos

Un entorno de desarrollo que permita crear un servidor local que soporte PHP 7.2.18 y MySQL 5.7.26.

```
Programas como wampserver y xampp ofrecen un entorno de desarrollo que cumplen con estos requisitos.
```

## 🎈 Uso <a name="usage"></a>

El uso de este sitio web busca ser los mas sencillo posible para cualquier usuario, un registro rapido, un manejo rapido y sencillo de los contactos con solo los campos basicos y algunas opciones extra para manejar el perfil de cada usuario.

Cuando el usuario ingrese a cualquier sitio de la carpeta web_sites y no tenga una sesion iniciada, sera dirigido el sitio de inicio de sesion.

Una vez iniciada la sesion, el usuario podra ver los contactos que ha agregado y las opciones de editar y eliminar de cada contacto. En la parte superior se encontrara una barra de navegación, en donde tendra un boton para regresar a la pagina principal, otro para agregar un contacto y un menu para entrar a las opciones de su perfil y para cerrar sesion.

## ⛏️ Construido con <a name = "built_using"></a>

- [MySQL](https://www.mysql.com/) - Base de datos
- [PHP](https://www.php.net/) - Backend
- [Bootstrap 4](https://getbootstrap.com/) -  CSS framework
- [JQuery](https://popper.js.org/)  - solo para boostrap 4
- [popper](https://jquery.com/) - solo para boostrap 4

## ✍️ Autores <a name = "authors"></a>

- [@SantiagoEsc1216](https://github.com/SantiagoEsc1216) - Idea y desarrollo completo.
