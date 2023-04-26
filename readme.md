# Siroko API Carrito

<img align="right" src="https://josellovell.com/wp-content/uploads/2022/04/symfony.png" width="220" alt=""/>

![OS](https://img.shields.io/badge/OS-Linux-red?style=flat&logo=linux)
![PHP](https://img.shields.io/badge/PHP-Symfony-blue)
![Docker](https://img.shields.io/badge/Docker-available-green.svg?style=flat&logo=docker)
![Documentation](https://img.shields.io/badge/Documentation-complete-green.svg?style=flat)

<!-- TOC -->

* [Siroko API Carrito](#siroko-api-carrito)
    * [1. Instalación de Symfony](#1-instalación-de-symfony)
    * [2. Configuración del framework para trabajar con docker](#2-configuración-del-framework-para-trabajar-con-docker)
        * [Por que docker?](#por-que-docker)
        * [Generamos archivo docker compose y dockerfile](#generamos-archivo-docker-compose-y-dockerfile)
    * [3. Dependencias necesarias](#3-dependencias-necesarias)
    * [4. Uso de la API](#4-uso-de-la-api)
    * [5. Modelado de la aplicación](#5-modelado-de-la-aplicación)
    * [6. Pruebas Unitarias](#6-pruebas-unitarias)
    * [7. Webgrafía y referencias.](#7-webgrafía-y-referencias)

<!-- TOC -->

## 1. Instalación de Symfony

Para comenzar el proyecto, lo primero que hicimos fue instalar Composer en nuestro sistema.

Composer es una herramienta de administración de paquetes de PHP que nos permitirá instalar y administrar las
dependencias de nuestro
proyecto de forma sencilla.

Lo instalamos con el siguiente comando:

```
sudo apt-get update
sudo apt-get install composer
```

Una vez instalado ejecutamos el siguiente comando para crear un nuevo proyecto Symfony:

```
composer create-project symfony/skeleton .
```

Esto ya nos genera la estructura de carpetas de un proyecto symfony.

<img  src="assets/structure.png" alt="">

## 2. Configuración del framework para trabajar con docker

### Por que docker?

Utilizamos para este proyecto para que nos permita utilizar el proyecto en cualquier equipo con docker
sin necesidad de más configuraciones que tener instalado docker.

### Generamos archivo docker compose y dockerfile

Generamos las configuraciones necesarias en el archivo **docker-compose** para crear el contenedor:

* Necesitaremos una imagen con apache para desplegar la app
* Una imagen con php
* Una imagen con base de datos para almacenar nuestra información.

<img  src="assets/dockercompose.png" width="550" alt="">

Generamos las configuraciones necesarias en el archivo **Dockerfile** para las configuraciones dentro del contenedor:

* Necesitamos cambiar la ruta del index de apache a nuestro index
* Activar el modulo rewrite de apache para cambiar la ruta
* Copiar el archivo 000-default personalizado dentro del contenedor

<img  src="assets/defaultconf.png" width="550" alt="">

## 3. Dependencias necesarias

## 4. Uso de la API

## 5. Modelado de la aplicación

## 6. Pruebas Unitarias

## 7. Webgrafía y referencias.
