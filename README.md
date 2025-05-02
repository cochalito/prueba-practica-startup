<div align="center"><img src="https://alphasremote.team/wp-content/uploads/2023/06/cropped-logo.png" width="300"/></div>
<h1> Prueba Practica </h1>
<div align="right">Brayan Pereyra Suxo</div>

## Introduccion y Objetivo 📄
Desea una aplicación en PHP (en consola) donde tome como mínimo las tres primeras letras para consultar coincidencias en el nombre de sus clases y exámenes en su base de datos.

Al ser dos tipos de recursos (clases y exámenes), estos deben mostrar diferentes datos. En el caso de las clases, debe incluir el nombre de la clase y ponderación de la clase con base en 5 puntos. Por parte del examen, debe mostrar el nombre del exámen y tipo de examen (selección, pregunta y respuesta, completación). Además de cada uno de sus atributos a mostrar anteriormente mencionados, deben indicar si es una clase o un examen.

## Requisitos para instalación 📋
Los requisitos para instalar este aplicativo en un servidor son los siguiente:

* **PHP** en una version 8.1 o superior
* **Composer**
* Un motor de DB **MySql** con versión 8.0 o superior


## Instalación 🔧

Para realizar la instalacion debemos seguir los siguiente pasos:

### Paso 1: Clonación del Repositorio

_Debemos clonar el repositorio actual al servidor donde realizaremos la instalación_

```
git clone git@github.com:cochalito/prueba-practica-startup.git
```
Al terminar este paso tendremos instalada la carpeta **prueba-practica-startup**
![image](https://github.com/user-attachments/assets/ab3c797c-6997-4c1d-bcec-22f607cf0adc)


### Paso 2: Ejecución de composer

_Cuando tengamos instalado los archivos del repositorio, debemos ejecutar composer_

```
$ composer install
```
Al terminar este paso tendremos configurado la carpeta **vendor** y el archivo **composer.lock**. La presencia de esta carpeta y archivo confirmaremos que se instalado composer correctamente.

![image](https://github.com/user-attachments/assets/27033038-b5da-4d01-92e3-8f1eec19df94)
![image](https://github.com/user-attachments/assets/e34b6972-36ae-49a2-88f8-a02a5aea4a7f)


### Paso 3: Variables de entorno

_Ahora necesitamos configurar las variables de entorno para la configuracion de DB. Para lo cual renombraremos el archivo **env-example** con el siguiente comando_

```
$ mv env-example .env
```

En el nuevo archivo **.env** necesitamos configurar las variables de conexión a DB, para lo cual necesitamos colocar los siguientes valores:
* DB_HOST : El hosting del servidor o localhost si se encuentra activado.
* DB_NAME : Nombre de la DB a la cual nos vamos a conectar.
* DB_USER : Username para realizar la conexión.
* DB_PASS : Password para username ingresado.

![image](https://github.com/user-attachments/assets/f09c4090-c35f-480b-b55e-7f5e458f847b)


### Paso 4: Instalacion de tablas

_Con la configuración de la DB terminada, podemos ejecutar la instalacion de las tablas con el comando **php app.php install**_

```
$ php app.php install
```

![image](https://github.com/user-attachments/assets/567a21ba-a277-4b66-ab3c-e1f1289b2d4e)



