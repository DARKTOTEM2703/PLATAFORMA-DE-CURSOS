# Escuela de Cursos de Capacitación

## Descripción del Proyecto

Este proyecto es una plataforma web para gestionar la inscripción, administración y pago de cursos de capacitación. Incluye un sistema de administración para gestionar cursos y usuarios, además de una interfaz para que los estudiantes puedan inscribirse y realizar pagos en línea mediante Stripe.

---

## Tecnologías Utilizadas

### Backend

- **PHP**: Lógica del servidor y conexión con la base de datos.
- **MySQL**: Base de datos relacional para usuarios, cursos e inscripciones.
- **Composer**: Gestor de dependencias.
  - **PHPMailer**: Envío de correos electrónicos.
  - **vlucas/phpdotenv**: Gestión de variables de entorno.
  - **stripe/stripe-php**: Integración con Stripe.

### Frontend

- **HTML5**: Estructura de las páginas.
- **CSS3**: Estilización de la interfaz.
  - **Bootstrap 5**: Framework CSS para diseño responsivo.
- **JavaScript**: Funcionalidades dinámicas.
  - **Fetch API**: Carga dinámica de datos.
  - **jQuery**: Manipulación del DOM.

### Infraestructura

- **XAMPP**: Servidor local.
- **Stripe**: Pasarela de pagos.
- **SMTP**: Envío de correos electrónicos.

---

## Estructura del Proyecto

```
├── admin/
│   ├── agregar_cursos.php
│   ├── ver_cursos.php
│   ├── usuarios.php
│   ├── api/
│   │   └── webhook_pago.php
├── landing/
│   ├── index.php
│   ├── inscripcion.php
│   ├── send_email.php
│   ├── success.php
├── logs/
├── vendor/
├── .env
├── composer.json
└── readme.md
```

### Descripción de Carpetas y Archivos

#### **`admin/`**

- **`agregar_cursos.php`**: Agregar nuevos cursos.
- **`ver_cursos.php`**: Lista de cursos.
- **`usuarios.php`**: Gestión de usuarios.
- **`api/webhook_pago.php`**: Manejo de eventos de Stripe.

#### **`landing/`**

- **`index.php`**: Página principal.
- **`inscripcion.php`**: Formulario de inscripción.
- **`send_email.php`**: Envío de correos de confirmación.
- **`success.php`**: Confirmación de pago.

#### **`logs/`**

- Registros de eventos importantes.

#### **`vendor/`**

- Dependencias instaladas con Composer.

#### **`.env`**

- Variables sensibles como claves de Stripe y credenciales SMTP.

---

## Funcionalidades Principales

1. **Gestión de Cursos**

   - Agregar, editar y eliminar cursos.
   - Detalles: nombre, docente, horario, días, objetivo y precio.

2. **Gestión de Usuarios**

   - Crear y eliminar usuarios.
   - Roles: `admin` o `usuario`.

3. **Inscripción de Estudiantes**

   - Formulario de inscripción.
   - Correo de confirmación con enlace de pago.

4. **Pagos en Línea**

   - Integración con Stripe.
   - Validación de pagos mediante webhook.

5. **Panel Administrativo**
   - Estadísticas y gestión centralizada.

---

## Configuración del Proyecto

### Requisitos Previos

- PHP 7.4 o superior.
- Composer instalado.
- Servidor local (XAMPP o WAMP).
- Claves de Stripe y credenciales SMTP.

### Instalación

1. Clona el repositorio:

   ```bash
   git clone https://github.com/DARKTOTEM2703/Subir-Tarea-3-.--Formulario-Cursos-JS
   ```

2. Instala las dependencias:

   ```bash
   cd Subir-Tarea-3-.--Formulario-Cursos-JS
   composer install
   ```

3. Configura el archivo `.env`:
   ```env
   STRIPE_SECRET_KEY=sk_test_...
   STRIPE_PUBLISHABLE_KEY=pk_test_...
   SMTP_HOST=smtp.gmail.com
   SMTP_PORT=587
   SMTP_USERNAME=correo@gmail.com
   SMTP_PASSWORD=contraseña
   ```

---

**Desarrollador**: Jafeth Daniel Gamboa Baas.

**Contacto**: [jafethgamboa27@gmail.com](mailto:jafethgamboa27@gmail.com)  
**Repositorio**: [GitHub](https://github.com/DARKTOTEM2703/Subir-Tarea-3-.--Formulario-Cursos-JS)
