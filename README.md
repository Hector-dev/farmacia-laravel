# Sistema de Gestión Farmacéutica

Un sistema completo de gestión para farmacias desarrollado en Laravel 12, que permite administrar medicamentos, proveedores, empleados, clientes, almacenes y movimientos de inventario.

## 🚀 Características

### ✅ Funcionalidades Implementadas

- **Gestión de Medicamentos**: CRUD completo con categorías y proveedores
- **Gestión de Proveedores**: Registro y administración de proveedores
- **Gestión de Categorías**: Clasificación de medicamentos
- **Gestión de Empleados**: Registro de personal de la farmacia
- **Gestión de Clientes**: Registro con historial médico y alergias
- **Gestión de Almacenes**: Control de múltiples ubicaciones
- **Movimientos de Inventario**: Entradas y salidas con control de stock
- **Interfaz Responsiva**: Diseño moderno con Bootstrap 5
- **Validaciones**: Frontend y backend completas
- **Relaciones**: Base de datos normalizada con claves foráneas

### 🏗️ Arquitectura

- **Backend**: Laravel 12 (PHP 8.2+)
- **Base de Datos**: MySQL/PostgreSQL
- **Frontend**: Blade Templates + Bootstrap 5
- **Patrón**: MVC (Model-View-Controller)

## 📋 Requisitos

- PHP 8.2 o superior
- Composer
- MySQL 8.0+ o PostgreSQL 13+
- Servidor web (Apache/Nginx)

## 🛠️ Instalación

1. **Clonar el repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd farmaceutica-app
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar variables de entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurar base de datos en `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=farmacia_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

6. **Poblar base de datos con datos de prueba**
   ```bash
   php artisan db:seed
   ```

7. **Iniciar servidor de desarrollo**
   ```bash
   php artisan serve
   ```

## 🗄️ Estructura de Base de Datos

### Tablas Principales

- **suppliers**: Proveedores de medicamentos
- **categories**: Categorías de medicamentos
- **medicines**: Medicamentos con stock y precios
- **employees**: Personal de la farmacia
- **customers**: Clientes con historial médico
- **warehouses**: Almacenes y ubicaciones
- **inventory_movements**: Movimientos de entrada/salida

### Relaciones

- Medicamentos → Proveedores (N:1)
- Medicamentos → Categorías (N:1)
- Movimientos → Medicamentos (N:1)
- Movimientos → Almacenes (N:1)
- Movimientos → Empleados (N:1)
- Movimientos → Clientes (N:1)

## 🎯 Casos de Uso

### Gestión de Medicamentos
- Crear, editar, eliminar medicamentos
- Control de stock automático
- Fechas de vencimiento
- Precios y códigos únicos

### Movimientos de Inventario
- Entradas de stock (compras)
- Salidas de stock (ventas)
- Validación de stock disponible
- Historial completo de movimientos

### Gestión de Clientes
- Registro con datos personales
- Historial médico
- Alergias y contraindicaciones
- Seguimiento de compras

## 🔧 Configuración Avanzada

### Personalización de Validaciones

Las validaciones se encuentran en los controladores:
- `app/Http/Controllers/MedicineController.php`
- `app/Http/Controllers/SupplierController.php`
- etc.

### Agregar Nuevas Categorías

1. Acceder a `/categories`
2. Crear nueva categoría
3. Asignar a medicamentos existentes

### Configurar Almacenes

1. Acceder a `/warehouses`
2. Crear almacén con capacidad
3. Asignar gerente responsable

## 📊 Reportes y Estadísticas

El sistema incluye:
- Stock actual por medicamento
- Movimientos recientes
- Clientes más frecuentes
- Medicamentos más vendidos

## 🔒 Seguridad

- Validación de datos en frontend y backend
- Protección CSRF
- Sanitización de inputs
- Control de acceso preparado para roles

## 🚀 Despliegue

### Producción

1. Configurar variables de entorno para producción
2. Optimizar autoloader:
   ```bash
   composer install --optimize-autoloader --no-dev
   ```
3. Cachear configuraciones:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### Docker (Opcional)

```dockerfile
FROM php:8.2-fpm
# ... configuración del Dockerfile
```

## 🤝 Contribución

1. Fork el proyecto
2. Crear rama para feature (`git checkout -b feature/AmazingFeature`)
3. Commit cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 📞 Soporte

Para soporte técnico o consultas:
- Crear un issue en el repositorio
- Contactar al equipo de desarrollo

## 🔄 Actualizaciones

### Próximas Funcionalidades

- [ ] Sistema de autenticación y autorización
- [ ] Reportes avanzados con gráficos
- [ ] API REST para integración
- [ ] Notificaciones automáticas
- [ ] Gestión de lotes
- [ ] Integración con sistemas de facturación

---

**Desarrollado con ❤️ usando Laravel 12**
