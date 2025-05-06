# Escuela de Cursos de Capacitación

## Descripción del Proyecto

Este proyecto es una plataforma web diseñada para gestionar la inscripción, administración y pago de cursos de capacitación. Incluye un sistema de administración para gestionar cursos y usuarios, así como una interfaz para que los estudiantes puedan inscribirse y realizar pagos en línea mediante la integración con Stripe.

---

## Tecnologías Utilizadas

### Backend

- **PHP**: Lenguaje principal para la lógica del servidor y la interacción con la base de datos.
- **MySQL**: Base de datos relacional para almacenar información de usuarios, cursos e inscripciones.
- **Composer**: Gestor de dependencias para PHP.
  - **PHPMailer**: Para el envío de correos electrónicos.
  - **vlucas/phpdotenv**: Para la gestión de variables de entorno.
  - **stripe/stripe-php**: Para la integración con la pasarela de pagos Stripe.

### Frontend

- **HTML5**: Estructura de las páginas web.
- **CSS3**: Estilización de la interfaz de usuario.
  - **Bootstrap 5**: Framework CSS para diseño responsivo y componentes predefinidos.
- **JavaScript**: Funcionalidades dinámicas en el cliente.
  - **Fetch API**: Para la carga dinámica de datos.
  - **jQuery**: Para manipulación del DOM y eventos.

### Infraestructura

- **XAMPP**: Servidor local para ejecutar Apache, PHP y MySQL.
- **Stripe**: Pasarela de pagos para gestionar transacciones en línea.
- **SMTP**: Protocolo para el envío de correos electrónicos.

---

## Estructura del Proyecto

```
├── admin/
│ ├── agregar_cursos.php
│ ├── agregar_usuarios.php
│ ├── cursos.php
│ ├── dashboard.php
│ ├── eliminar_curso.php
│ ├── eliminar_usuarios.php
│
├── generar_hash.php
│ ├── login.php
│ ├── usuarios.php
│ ├── ver_cursos.php
│ ├── ver_usuarios.php
│ ├── api/
│ │ └── webhook_pago.php
│ ├── css/
│ ├── db/
│ ├── elements/
│ ├── img/
│ ├── js/
│ └── references/
├── landing/
│ ├── cursos.php
│ ├── index.php
│ ├── inscripcion.php
│ ├── send_email.php
│ ├── success.php
│ ├── components/
│ ├── css/
│ └── img/
├── logs/
├── vendor/
├── .env
├── .gitignore
├── composer.json
├── composer.lock
└── readme.md
```

### Descripción de Carpetas y Archivos Principales

#### **`admin/`**

- **`agregar_cursos.php`**: Permite a los administradores agregar nuevos cursos con detalles como nombre, docente, horario, días y precio.
- **`ver_cursos.php`**: Muestra una lista de todos los cursos disponibles en la base de datos.
- **`usuarios.php`**: Gestión de usuarios, incluyendo la creación y eliminación.
- **`api/webhook_pago.php`**: Endpoint para manejar los eventos de Stripe, como la confirmación de pagos.

#### **`landing/`**

- **`index.php`**: Página principal para los usuarios, con información sobre la escuela y un enlace para inscribirse.
- **`inscripcion.php`**: Formulario de inscripción para los estudiantes, que incluye selección de curso y método de pago.
- **`send_email.php`**: Lógica para enviar correos electrónicos de confirmación con enlaces de pago.
- **`success.php`**: Página de confirmación que muestra el estado del pago después de completar una transacción.

#### **`logs/`**

- Almacena los registros de eventos importantes, como intentos de inicio de sesión y errores.

#### **`vendor/`**

- Contiene las dependencias instaladas mediante Composer.

#### **`.env`**

- Archivo de configuración para almacenar variables sensibles como claves de Stripe y credenciales SMTP.

---

## Funcionalidades Principales

### 1. **Gestión de Cursos**

- Los administradores pueden agregar, editar y eliminar cursos.
- Los cursos incluyen detalles como nombre, docente, horario, días, objetivo y precio.

### 2. **Gestión de Usuarios**

- Los administradores pueden crear y eliminar usuarios.
- Los usuarios tienen roles (`admin` o `usuario`) para controlar el acceso.

### 3. **Inscripción de Estudiantes**

- Los estudiantes pueden inscribirse en cursos mediante un formulario.
- Se envía un correo de confirmación con un enlace para realizar el pago.

### 4. **Pagos en Línea**

- Integración con Stripe para procesar pagos de manera segura.
- Los pagos se validan mediante un webhook que actualiza el estado de la inscripción.

### 5. **Panel Administrativo**

- Los administradores pueden ver estadísticas, gestionar cursos y usuarios desde un panel centralizado.

---

## Configuración del Proyecto

### Requisitos Previos

- PHP 7.4 o superior.
- Composer instalado.
- Servidor local como XAMPP o WAMP.
- Claves de Stripe y credenciales SMTP.

### Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/DARKTOTEM2703/Subir-Tarea-3-.--Formulario-Cursos-JS
   ```

### configuarcion de dependencias

2. Instala las
   dependencias con Composer:
   ```powerShell
   cd Subir-Tarea-3-.--Formulario-Cursos-JS
   composer install
   composer require phpmailer/phpmailer
   composer require vlucas/phpdotenv
   composer require stripe/stripe-php
   ```
3. Crea un archivo `.env` en la raíz del proyecto y configura las variables de entorno necesarias.
   ```
   # Variables de entorno
   STRIPE_SECRET_KEY=sk_test_51H5...# Tu clave secreta de Stripe
   STRIPE_PUBLISHABLE_KEY=pk_test_51H5...# Tu clave pública de Stripe
   SMTP_HOST=smtp.gmail.com
   SMTP_PORT=587
   SMTP_USERNAME=correo@gmail.com
   SMTP_PASSWORD=contraseña
   ```
   Reemplaza `sk_test_51H5...` y `pk_test_51H5...` con tus claves de Stripe.
   Reemplaza `correo@gmail.com` y `contraseña` con tus credenciales de correo electrónico.
