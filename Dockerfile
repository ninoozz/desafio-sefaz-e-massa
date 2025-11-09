FROM php:8.2-cli

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar Node.js 20.x
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos de dependências primeiro (otimização de cache)
COPY composer.json composer.lock ./
COPY package.json package-lock.json* ./

# Instalar dependências PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Instalar dependências Node
RUN npm ci --legacy-peer-deps || npm install --legacy-peer-deps

# Copiar o resto dos arquivos
COPY . .

# Executar scripts do Composer e gerar autoloader
RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi || true

# Nota: Assets serão compilados em tempo real pelo Vite dev server
# Para produção, descomente a linha abaixo:
# RUN npm run build

# Criar diretórios necessários e ajustar permissões
RUN mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expor portas
EXPOSE 8000 5173

# Comando padrão
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
