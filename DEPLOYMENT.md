# Deployment Guide

Panduan untuk deploy aplikasi AMGPM ke VPS menggunakan GitHub Actions.

## Prerequisites

1. **VPS Server** dengan:
   - Ubuntu/Debian Linux
   - PHP 8.2+
   - Composer
   - Nginx/Apache
   - MySQL/PostgreSQL
   - Node.js 18+

2. **SSH Access** ke VPS

## Setup GitHub Secrets

Tambahkan secrets berikut di GitHub repository:

### Required Secrets

1. **SSH_HOST**
   - Value: IP address atau domain VPS Anda
   - Contoh: `192.168.1.100` atau `yourdomain.com`

2. **SSH_USER**
   - Value: Username untuk SSH ke VPS
   - Contoh: `ubuntu`, `root`, atau user lainnya

3. **SSH_KEY**
   - Value: Private SSH key untuk akses ke VPS
   - Generate dengan: `ssh-keygen -t rsa -b 4096 -C "your_email@example.com"`
   - Copy isi file `~/.ssh/id_rsa` (private key)

### Cara Menambahkan Secrets

1. Buka repository di GitHub
2. Go to **Settings** → **Secrets and variables** → **Actions**
3. Click **New repository secret**
4. Tambahkan masing-masing secret dengan nama dan value yang sesuai

## Setup VPS Server

### 1. Install Dependencies

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP 8.2
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.2 php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd php8.2-intl

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs

# Install Nginx
sudo apt install nginx

# Install MySQL
sudo apt install mysql-server
```

### 2. Setup SSH Key

```bash
# Di local machine, copy public key ke server
ssh-copy-id username@your-server-ip

# Atau manual:
# 1. Copy isi ~/.ssh/id_rsa.pub
# 2. Di server, tambahkan ke ~/.ssh/authorized_keys
```

### 3. Setup Application Directory

```bash
# Create app directory
sudo mkdir -p /var/www/amgpm
sudo chown -R www-data:www-data /var/www/amgpm
sudo chmod -R 755 /var/www/amgpm

# Create .env file
sudo nano /var/www/amgpm/.env
```

### 4. Configure Nginx

Buat file konfigurasi Nginx:

```bash
sudo nano /etc/nginx/sites-available/amgpm
```

Isi dengan:

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/amgpm/public;

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
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Aktifkan site:

```bash
sudo ln -s /etc/nginx/sites-available/amgpm /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 5. Setup Database

```bash
# Login ke MySQL
sudo mysql

# Buat database dan user
CREATE DATABASE amgpm;
CREATE USER 'amgpm_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON amgpm.* TO 'amgpm_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 6. Environment File (.env)

Buat file `.env` di `/var/www/amgpm/.env`:

```env
APP_NAME=AMGPM
APP_ENV=production
APP_KEY=base64:your-app-key-here
APP_DEBUG=false
APP_URL=http://your-domain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=amgpm
DB_USERNAME=amgpm_user
DB_PASSWORD=your_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

## Deployment Process

### Automatic Deployment

Deployment akan berjalan otomatis ketika:
1. Push ke branch `main` atau `master`
2. Merge Pull Request ke branch `main` atau `master`

### Manual Deployment

1. Go to **Actions** tab di GitHub repository
2. Select **Deploy to VPS** workflow
3. Click **Run workflow**
4. Choose branch dan click **Run workflow**

## Workflow Steps

1. **Checkout Code**: Download source code
2. **Setup PHP**: Install PHP 8.2 dan extensions
3. **Cache Dependencies**: Cache Composer packages
4. **Install Dependencies**: Install PHP dependencies
5. **Setup Node.js**: Install Node.js 18
6. **Install NPM**: Install JavaScript dependencies
7. **Build Assets**: Compile CSS/JS dengan Vite
8. **Create Archive**: Buat archive deployment
9. **Upload Files**: Upload ke VPS via SCP
10. **Extract & Setup**: Extract files dan setup aplikasi
11. **Run Commands**: Jalankan Laravel commands

## Troubleshooting

### Common Issues

1. **Permission Denied**
   ```bash
   sudo chown -R www-data:www-data /var/www/amgpm
   sudo chmod -R 775 /var/www/amgpm/storage
   sudo chmod -R 775 /var/www/amgpm/bootstrap/cache
   ```

2. **SSH Connection Failed**
   - Pastikan SSH key sudah ditambahkan ke server
   - Cek firewall settings
   - Pastikan SSH service berjalan

3. **Database Connection Error**
   - Cek kredensial database di .env
   - Pastikan MySQL service berjalan
   - Cek user permissions

4. **Storage Link Error**
   ```bash
   cd /var/www/amgpm
   php artisan storage:link
   ```

### Logs

Cek logs untuk debugging:

```bash
# Application logs
tail -f /var/www/amgpm/storage/logs/laravel.log

# Nginx logs
sudo tail -f /var/log/nginx/error.log
sudo tail -f /var/log/nginx/access.log

# PHP-FPM logs
sudo tail -f /var/log/php8.2-fpm.log
```

## Security Notes

1. **Jangan commit .env file** ke repository
2. **Gunakan strong passwords** untuk database
3. **Setup firewall** untuk membatasi akses
4. **Regular updates** sistem dan dependencies
5. **Backup database** secara berkala

## Backup Strategy

```bash
# Database backup
mysqldump -u amgpm_user -p amgpm > backup_$(date +%Y%m%d).sql

# Files backup
tar -czf amgpm_backup_$(date +%Y%m%d).tar.gz /var/www/amgpm
```