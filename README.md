## Proyecto-Contabilidad
Este es el repositorio para el proyecto de diseño de un software de contabilidad


## Comandos

# Para migrar las bases de datos
php artisan migrate
php artisan migrate:fresh
php artisan migrate:fresh --seed

# Para migrar sin generar la migracion
php artisan db:seed

# Para crear una tabla
php artisan make:migration Deudas
php artisan make:migration Roles
php artisan make:migration create_puc_comercial_table
php artisan make:migration Permisos
php artisan make:migration Usuarios_tienen_permisos
php artisan make:migration Plantillas
php artisan make:migration Plantillas_tienen_permisos
php artisan make:migration Imagenes_tickets
php artisan make:migration Categorias_tickets

## Todo lo de terceros

php artisan make:migration Tipo_documento
php artisan make:migration Regimen
php artisan make:migration Tipo_persona
php artisan make:migration Divipola
php artisan make:migration Paises
php artisan make:migration Terceros

# Para crear un cargador automatico de datos
php artisan make:seeder PucComercialSeeder
php artisan make:seeder CategoriasSeeder
php artisan make:seeder TerceroSeeder



# Para crear un controlador
php artisan make:controller LoginController
php artisan make:controller RegisterController
php artisan make:controller HomeController
php artisan make:controller RutController
php artisan make:controller PermisosController
php artisan make:controller TicketsController
php artisan make:controller ArchivosController
php artisan make:controller DataController
php artisan make:controller ParametricosController
php artisan make:controller GraficosController
php artisan make:controller TercerosController


# Para crear middleware

php artisan make:middleware CheckPermisos

# Con esto puedo hacer request personalizados para solicitudes, ponerle las reglas que quieras
php artisan make:request LoginRequest
php artisan make:request RegisterRequest
php artisan make:request EditarUserRequest

# Para entrar al comando de mysql
mysql -u root -p

# Para entrar al contenedor
docker exec -it saas-app-1 bash

# Para modelos
php artisan make:model Deudas
php artisan make:model Permiso
php artisan make:model UsuarioPermiso
php artisan make:model UsuarioPermiso
php artisan make:model ImagenTicket
php artisan make:model Categoria

## Todo lo de terceros

php artisan make:model TipoDocumento
php artisan make:model Regimen
php artisan make:model TipoPersona
php artisan make:model Divipola
php artisan make:model Paises
php artisan make:model Terceros

# Para recargar el composer.json
composer dump-autoload


# Actualizado de composer
composer update
composer update mockery/mockery nette/schema
composer require yajra/laravel-datatables-oracle



# Nuevas cosas 

php artisan make:migration create_facturas_table
php artisan make:model Factura

php artisan make:migration create_metodos_de_pago_table
php artisan make:model MetodoDePago

php artisan make:migration create_pagos_facturas_table
php artisan make:model PagoFactura

php artisan make:migration create_permisos_table
php artisan make:model Permiso

php artisan make:migration create_usuarios_table
php artisan make:model Usuario

php artisan make:migration create_usuarios_has_permisos_table
php artisan make:model UsuariosHasPermisos

php artisan storage:link



php artisan make:controller FacturasController
php artisan make:controller InformesController


Pasos para instalar en windows server

1) Instalar xampp: https://www.apachefriends.org/es/index.html

2) Configurar xampp para que se inicie automaticamente

    Configurar XAMPP para iniciar automáticamente con Windows:

        Abre el Panel de Control de XAMPP.
        Haz clic en el botón de configuración (config) junto a Apache y MySQL.
        Selecciona la opción "Service" para ambos servicios para instalarlos como servicios de Windows.
    
    Configurar los servicios para que se inicien automáticamente:

        Abre la consola de servicios de Windows (puedes buscar "services.msc" en el menú de inicio).
        Busca los servicios "Apache2.4" y "MySQL".
        Haz clic derecho en cada servicio, selecciona "Propiedades" y cambia el tipo de inicio a "Automático".

3) Instalar composer: https://getcomposer.org/download/

3) Hay que establecer la variable de entorno de composer en el path

4) Copiar el proyecto de laravel aquí C:\xampp\htdocs, este README no, ni los dockers, la carpeta CodigoBarras

5) Configurar la conexión a la base de datos en el .env

6) Ejecutar esto php artisan key:generate

7) Ejecutar esto php artisan migrate

8) Asegurarse de que el directorio storage y bootstrap/cache tienen permisos de escritura

9) Revisar que los servicios se inicien automaticamente al arrancar el servidor revisando los servicios en 'services.msc'

win + R

services.msv



Busco los dos de apache y MYSQL 

Propiedades, tipo de inicio automatico, aplicar, aceptar
