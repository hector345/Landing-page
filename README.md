# Prueba Técnica: Landing Page

## Descripción

Este proyecto consiste en crear una landing page sencilla siguiendo las siguientes características:

- Utilizar el archivo PSD (`Landing_webinar2.psd`) como base para el diseño de la landing.
- Incluir un formulario de registro tal como se muestra en `01.jpg`.
- Enviar los datos del formulario por correo electrónico a una cuenta de su elección con copia a `raul@difraxion.com` y el asunto "TEST DFX".
- Al enviar los datos, reemplazar el formulario con un video incrustado como se muestra en `02.jpg` (puede ser un video de cualquier plataforma).
- Asegurarse de que el sitio sea responsivo.
- Montar el sitio en un hosting (opcional, pero preferido).
- No usar un framework.

## Requisitos

- **Diseño**: Basado en `Landing_webinar2.psd`.
- **Formulario**: Debe estar presente y funcionar como en `01.jpg`.
- **Envío de datos**: Los datos del formulario deben ser enviados por correo electrónico.
- **Video**: El formulario debe ser reemplazado por un video después de enviar los datos, como en `02.jpg`.
- **Responsividad**: El sitio debe adaptarse a diferentes tamaños de pantalla.
- **Hosting**: Se recomienda montar el sitio en un servidor.

## Pasos para la Implementación

1. **Diseño**: Utilizar `Landing_webinar2.psd` para crear el diseño de la landing page.
2. **Formulario de Registro**: Incluir un formulario de registro según `01.jpg`.
3. **Envío de Datos por Correo**:
   - Configurar el envío de los datos del formulario a una cuenta de correo con copia a `raul@difraxion.com`.
   - Asegurarse de que el correo tenga el asunto "TEST DFX".
4. **Reemplazo del Formulario por Video**:
   - Al enviar el formulario, sustituirlo por un video incrustado (puede ser de cualquier plataforma).
5. **Responsividad**: Asegurarse de que la página sea responsiva y se vea bien en diferentes dispositivos.
6. **Hosting** (opcional, pero preferido):
   - Montar el sitio en un hosting y proporcionar la URL.

## Evidencia

- Comprimir y enviar los archivos del proyecto a `raul@difraxion.com`. Si el archivo es muy grande, utilizar WeTransfer.
- Si el sitio se subió a un servidor, incluir la URL en el correo.

## Diseño de Base de datos

```sql
CREATE TABLE `contacts` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `telefono` VARCHAR(255) NOT NULL,
    `ciudad` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

```
