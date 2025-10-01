# RentalPS - Panduan Deployment Production

## Persyaratan Server

### Minimum Requirements
- PHP 8.1 atau lebih tinggi
- MySQL 8.0 atau MariaDB 10.3+
- Nginx atau Apache
- Composer
- Node.js & NPM (untuk build assets)
- SSL Certificate (untuk HTTPS)

### PHP Extensions Required
```
- BCMath
- Ctype
- cURL
- DOM
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PCRE
- PDO
- Tokenizer
- XML
- GD atau Imagick (untuk image processing)
```

## Langkah-langkah Deployment

### 1. Upload Files ke Server
```bash
# Upload semua file project ke server (kecuali folder berikut):
# - node_modules/
# - .env (gunakan .env.production)
# - storage/logs/*
# - bootstrap/cache/*
```

### 2. Setup Environment
```bash
# Copy file environment production
cp .env.production .env

# Edit file .env dengan konfigurasi server Anda:
# - APP_URL: domain website Anda
# - DB_*: konfigurasi database production
# - MAIL_*: konfigurasi SMTP email
# - SESSION_DOMAIN: domain website Anda
```

### 3. Install Dependencies
```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node.js dependencies dan build assets
npm install
npm run build
```

### 4. Setup Database
```bash
# Generate application key (jika belum ada)
php artisan key:generate

# Run database migrations
php artisan migrate --force

# Seed database dengan data awal
php artisan db:seed --force
```

### 5. Optimize Laravel
```bash
# Cache konfigurasi
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Cache events
php artisan event:cache
```

### 6. Set Permissions
```bash
# Set permission untuk storage dan bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set ownership (sesuaikan dengan user web server)
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

### 7. Web Server Configuration

#### Nginx Configuration
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;
    root /path/to/your/project/public;

    # SSL Configuration
    ssl_certificate /path/to/ssl/certificate.crt;
    ssl_certificate_key /path/to/ssl/private.key;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### Apache Configuration (.htaccess sudah ada di public folder)
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /path/to/your/project/public
    Redirect permanent / https://yourdomain.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName yourdomain.com
    DocumentRoot /path/to/your/project/public
    
    SSLEngine on
    SSLCertificateFile /path/to/ssl/certificate.crt
    SSLCertificateKeyFile /path/to/ssl/private.key
    
    <Directory /path/to/your/project/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## Konfigurasi Database Production

### 1. Buat Database Baru
```sql
CREATE DATABASE rental_ps_production CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'rental_user'@'localhost' IDENTIFIED BY 'secure_password_here';
GRANT ALL PRIVILEGES ON rental_ps_production.* TO 'rental_user'@'localhost';
FLUSH PRIVILEGES;
```

### 2. Update .env dengan kredensial database
```env
DB_DATABASE=rental_ps_production
DB_USERNAME=rental_user
DB_PASSWORD=secure_password_here
```

## Konfigurasi Email Production

### Gmail SMTP (Recommended)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="RentalPS"
```

**Note**: Untuk Gmail, gunakan App Password, bukan password akun biasa.

## Security Checklist

- [ ] APP_DEBUG=false di production
- [ ] APP_ENV=production
- [ ] Database credentials yang aman
- [ ] SSL Certificate terpasang
- [ ] SESSION_SECURE_COOKIE=true
- [ ] File .env tidak dapat diakses public
- [ ] Folder storage dan bootstrap/cache memiliki permission yang benar
- [ ] Backup database secara berkala
- [ ] Monitor log aplikasi secara rutin

## Maintenance Commands

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Update Application
```bash
# Pull latest code
git pull origin main

# Update dependencies
composer install --optimize-autoloader --no-dev

# Run migrations
php artisan migrate --force

# Rebuild cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Backup Database
```bash
mysqldump -u rental_user -p rental_ps_production > backup_$(date +%Y%m%d_%H%M%S).sql
```

## Monitoring & Logs

### Log Files Location
- Laravel Logs: `storage/logs/laravel.log`
- Web Server Logs: `/var/log/nginx/` atau `/var/log/apache2/`

### Monitoring Commands
```bash
# Monitor Laravel logs
tail -f storage/logs/laravel.log

# Check application status
php artisan about
```

## Troubleshooting

### Common Issues

1. **500 Internal Server Error**
   - Check file permissions
   - Check .env configuration
   - Check Laravel logs

2. **Database Connection Error**
   - Verify database credentials
   - Check database server status
   - Verify database exists

3. **Email Not Sending**
   - Check SMTP credentials
   - Verify firewall settings
   - Check email provider settings

### Support
Untuk bantuan lebih lanjut, hubungi developer atau check dokumentasi Laravel official.