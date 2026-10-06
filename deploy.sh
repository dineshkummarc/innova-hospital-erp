#!/usr/bin/env bash
# ==============================================================================
# LifeCare Hospital ERP - One-Click Deployment Script
# Designed for aaPanel / Ubuntu / Debian / CentOS Nginx & Apache Servers
# ==============================================================================

set -e

# Color definitions
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
BLUE='\033[0;34m'
BOLD='\033[1m'
NC='\033[0m' # No Color

echo -e "${CYAN}${BOLD}"
echo "=================================================================="
echo "          LifeCare Hospital ERP - Production Deployment           "
echo "=================================================================="
echo -e "${NC}"

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"
cd "$APP_DIR"

echo -e "${BLUE}[*] Project Directory:${NC} $APP_DIR"

# ------------------------------------------------------------------------------
# 1. Environment & Database Configuration (.env)
# ------------------------------------------------------------------------------
echo ""
echo -e "${CYAN}${BOLD}[1/7] Checking Environment Configuration (.env)...${NC}"

ENV_FILE="$APP_DIR/.env"
ENV_EXAMPLE="$APP_DIR/.env.example"

if [ -f "$ENV_FILE" ]; then
    echo -e "${GREEN}[✔] .env file already exists.${NC}"
else
    echo -e "${YELLOW}[!] .env file not found. Let's create it now.${NC}"
    
    # Check if running interactively
    if [ -t 0 ]; then
        echo -e "${BOLD}Please enter your Database details (press Enter to accept default):${NC}"
        read -p "Database Host [127.0.0.1]: " INPUT_DB_HOST
        DB_HOST=${INPUT_DB_HOST:-127.0.0.1}

        read -p "Database Port [3306]: " INPUT_DB_PORT
        DB_PORT=${INPUT_DB_PORT:-3306}

        read -p "Database Name [lifecare]: " INPUT_DB_NAME
        DB_NAME=${INPUT_DB_NAME:-lifecare}

        read -p "Database User [root]: " INPUT_DB_USER
        DB_USER=${INPUT_DB_USER:-root}

        read -s -p "Database Password: " INPUT_DB_PASS
        echo ""
        DB_PASS=$INPUT_DB_PASS

        read -p "Environment (production/development) [production]: " INPUT_CI_ENV
        CI_ENV=${INPUT_CI_ENV:-production}
    else
        # Non-interactive fallback
        DB_HOST="127.0.0.1"
        DB_PORT="3306"
        DB_NAME="lifecare"
        DB_USER="root"
        DB_PASS=""
        CI_ENV="production"
    fi

    cat <<EOF > "$ENV_FILE"
# Application Environment
CI_ENV=$CI_ENV

# Database Configuration
DB_HOST=$DB_HOST
DB_PORT=$DB_PORT
DB_NAME=$DB_NAME
DB_USER=$DB_USER
DB_PASS=$DB_PASS

# Base Domain
BASE_DOMAIN=lifecare.innovacomputersbd.com
EOF

    chmod 640 "$ENV_FILE"
    echo -e "${GREEN}[✔] .env file created successfully!${NC}"
fi

# Load variables from .env
set -a
[ -f "$ENV_FILE" ] && . "$ENV_FILE"
set +a

DB_HOST=${DB_HOST:-127.0.0.1}
DB_PORT=${DB_PORT:-3306}
DB_NAME=${DB_NAME:-lifecare}
DB_USER=${DB_USER:-root}
DB_PASS=${DB_PASS:-}

# ------------------------------------------------------------------------------
# 2. Database Connection & Import Check
# ------------------------------------------------------------------------------
echo ""
echo -e "${CYAN}${BOLD}[2/7] Checking Database Connection & Schema...${NC}"

if command -v mysql >/dev/null 2>&1; then
    MYSQL_AUTH="-h $DB_HOST -P $DB_PORT -u $DB_USER"
    if [ -n "$DB_PASS" ]; then
        MYSQL_AUTH="$MYSQL_AUTH -p$DB_PASS"
    fi

    # Create Database if it doesn't exist
    if mysql $MYSQL_AUTH -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null; then
        echo -e "${GREEN}[✔] Connected to MySQL. Database '$DB_NAME' is ready.${NC}"
        
        # Check if database has tables
        TABLE_COUNT=$(mysql $MYSQL_AUTH -D "$DB_NAME" -e "SHOW TABLES;" 2>/dev/null | wc -l)
        
        if [ "$TABLE_COUNT" -le 1 ]; then
            if [ -f "$APP_DIR/lifecare.sql" ]; then
                echo -e "${YELLOW}[!] Database '$DB_NAME' is empty. Importing initial schema from lifecare.sql...${NC}"
                mysql $MYSQL_AUTH "$DB_NAME" < "$APP_DIR/lifecare.sql"
                echo -e "${GREEN}[✔] lifecare.sql imported successfully!${NC}"
            else
                echo -e "${YELLOW}[!] No lifecare.sql found. Skipping import.${NC}"
            fi
        else
            echo -e "${GREEN}[✔] Database already contains tables ($((TABLE_COUNT - 1)) tables found). Skipping SQL import.${NC}"
        fi
    else
        echo -e "${RED}[!] Could not connect to MySQL with the credentials in .env.${NC}"
        echo -e "${YELLOW}Please verify DB_USER and DB_PASS in $ENV_FILE or ensure MySQL is running.${NC}"
    fi
else
    # Fallback check using PHP
    echo -e "${YELLOW}[!] mysql client not installed. Testing via PHP mysqli...${NC}"
    php -r "
        \$conn = @new mysqli('$DB_HOST', '$DB_USER', '$DB_PASS', '', (int)'$DB_PORT');
        if (\$conn->connect_error) {
            echo 'FAIL: ' . \$conn->connect_error . PHP_EOL;
            exit(1);
        }
        \$conn->query('CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        \$conn->select_db('$DB_NAME');
        \$res = \$conn->query('SHOW TABLES;');
        \$count = \$res ? \$res->num_rows : 0;
        echo 'SUCCESS:' . \$count . PHP_EOL;
    " > /tmp/db_test.txt 2>&1 || true

    if grep -q "SUCCESS" /tmp/db_test.txt 2>/dev/null; then
        T_COUNT=$(cat /tmp/db_test.txt | cut -d':' -f2 | tr -d '[:space:]')
        echo -e "${GREEN}[✔] Connected to MySQL via PHP! Found $T_COUNT tables.${NC}"
        if [ "$T_COUNT" -eq 0 ] && [ -f "$APP_DIR/lifecare.sql" ]; then
            echo -e "${YELLOW}[!] Importing lifecare.sql via PHP...${NC}"
            php -r "
                \$conn = new mysqli('$DB_HOST', '$DB_USER', '$DB_PASS', '$DB_NAME', (int)'$DB_PORT');
                \$sql = file_get_contents('$APP_DIR/lifecare.sql');
                \$conn->multi_query(\$sql);
            " || true
            echo -e "${GREEN}[✔] Import finished.${NC}"
        fi
    else
        echo -e "${YELLOW}[!] Notice: Could not auto-verify MySQL. Please ensure DB credentials are set in .env.${NC}"
    fi
    rm -f /tmp/db_test.txt
fi

# ------------------------------------------------------------------------------
# 3. Create Required Directories
# ------------------------------------------------------------------------------
echo ""
echo -e "${CYAN}${BOLD}[3/7] Ensuring Upload and Cache Directories Exist...${NC}"

REQUIRED_DIRS=(
    "uploads"
    "uploads/hospital"
    "uploads/staff"
    "uploads/patient"
    "invoicefile"
    "files"
    "application/cache"
    "application/logs"
)

for d in "${REQUIRED_DIRS[@]}"; do
    if [ ! -d "$APP_DIR/$d" ]; then
        mkdir -p "$APP_DIR/$d"
        echo -e "  ${GREEN}+ Created directory:${NC} $d"
    fi
done
echo -e "${GREEN}[✔] All required directories verified.${NC}"

# ------------------------------------------------------------------------------
# 4. Permissions & Ownership
# ------------------------------------------------------------------------------
echo ""
echo -e "${CYAN}${BOLD}[4/7] Setting File Permissions and Web Server Ownership...${NC}"

# Detect web server user in aaPanel / Ubuntu / CentOS
WEB_USER=""
WEB_GROUP=""

if id "www" >/dev/null 2>&1; then
    WEB_USER="www"
    WEB_GROUP="www"
elif id "www-data" >/dev/null 2>&1; then
    WEB_USER="www-data"
    WEB_GROUP="www-data"
elif id "nginx" >/dev/null 2>&1; then
    WEB_USER="nginx"
    WEB_GROUP="nginx"
elif id "apache" >/dev/null 2>&1; then
    WEB_USER="apache"
    WEB_GROUP="apache"
fi

if [ -n "$WEB_USER" ] && [ "$(id -u)" -eq 0 ]; then
    echo -e "  Detected web user: ${BOLD}$WEB_USER:$WEB_GROUP${NC}"
    # Temporarily remove immutable attribute on aaPanel's .user.ini if present
    if [ -f "$APP_DIR/.user.ini" ]; then
        chattr -i "$APP_DIR/.user.ini" 2>/dev/null || true
    fi
    chown -R "$WEB_USER:$WEB_GROUP" "$APP_DIR" 2>/dev/null || true
    if [ -f "$APP_DIR/.user.ini" ]; then
        chattr +i "$APP_DIR/.user.ini" 2>/dev/null || true
    fi
    echo -e "${GREEN}[✔] Ownership set to $WEB_USER:$WEB_GROUP.${NC}"
fi

# Directory and file permissions
find "$APP_DIR" -type d -exec chmod 755 {} + 2>/dev/null || true
find "$APP_DIR" -type f ! -name ".user.ini" -exec chmod 644 {} + 2>/dev/null || true

# Executable permissions for scripts
chmod +x "$APP_DIR/deploy.sh" 2>/dev/null || true

# Secure sensitive configuration and SQL files
[ -f "$ENV_FILE" ] && chmod 640 "$ENV_FILE" 2>/dev/null || true
[ -f "$APP_DIR/lifecare.sql" ] && chmod 640 "$APP_DIR/lifecare.sql" 2>/dev/null || true

# Writable directories for CodeIgniter uploads, cache, logs
for d in "${REQUIRED_DIRS[@]}"; do
    chmod -R 777 "$APP_DIR/$d" 2>/dev/null || chmod -R 775 "$APP_DIR/$d" 2>/dev/null || true
done
echo -e "${GREEN}[✔] Directory & file permissions configured safely.${NC}"

# ------------------------------------------------------------------------------
# 5. Clean Stale Cache
# ------------------------------------------------------------------------------
echo ""
echo -e "${CYAN}${BOLD}[5/7] Clearing CodeIgniter Temporary Cache...${NC}"

find "$APP_DIR/application/cache" -type f ! -name "index.html" ! -name ".gitkeep" -delete 2>/dev/null || true
echo -e "${GREEN}[✔] Cache directory cleaned.${NC}"

# ------------------------------------------------------------------------------
# 6. Check PHP Version & Essential Modules
# ------------------------------------------------------------------------------
echo ""
echo -e "${CYAN}${BOLD}[6/7] Checking PHP Version & Required Extensions...${NC}"

if command -v php >/dev/null 2>&1; then
    PHP_VER=$(php -r "echo PHP_VERSION;")
    echo -e "  Active PHP Version: ${BOLD}$PHP_VER${NC}"

    REQUIRED_EXTS=("mysqli" "curl" "mbstring" "gd" "zip" "json" "openssl" "xml")
    MISSING_EXTS=()

    for ext in "${REQUIRED_EXTS[@]}"; do
        if ! php -m | grep -qi "^$ext$"; then
            MISSING_EXTS+=("$ext")
        fi
    done

    if [ ${#MISSING_EXTS[@]} -eq 0 ]; then
        echo -e "${GREEN}[✔] All required PHP extensions are installed!${NC}"
    else
        echo -e "${YELLOW}[!] Warning: Missing recommended PHP extensions:${NC} ${MISSING_EXTS[*]}"
        echo -e "${YELLOW}In aaPanel: Go to App Store -> PHP -> Extensions and install them.${NC}"
    fi
else
    echo -e "${YELLOW}[!] PHP CLI not found in PATH.${NC}"
fi

# ------------------------------------------------------------------------------
# 7. Reload PHP-FPM / Web Server (OPcache flush)
# ------------------------------------------------------------------------------
echo ""
echo -e "${CYAN}${BOLD}[7/7] Reloading PHP-FPM & Web Server...${NC}"

RELOADED=0

# aaPanel init script reloads
for init_script in /etc/init.d/php-fpm-8* /etc/init.d/php-fpm-7*; do
    if [ -x "$init_script" ]; then
        "$init_script" reload >/dev/null 2>&1 || true
        RELOADED=1
    fi
done

# systemd service reloads
if [ "$RELOADED" -eq 0 ] && command -v systemctl >/dev/null 2>&1; then
    for svc in php8.3-fpm php8.2-fpm php8.1-fpm php8.0-fpm php-fpm; do
        if systemctl is-active --quiet "$svc" 2>/dev/null; then
            systemctl reload "$svc" 2>/dev/null || true
            RELOADED=1
            break
        fi
    done
fi

if [ "$RELOADED" -eq 1 ]; then
    echo -e "${GREEN}[✔] PHP-FPM reloaded (OPcache refreshed).${NC}"
else
    echo -e "${YELLOW}[*] PHP-FPM auto-reload skipped (can reload manually via aaPanel).${NC}"
fi

# ------------------------------------------------------------------------------
# Deployment Summary
# ------------------------------------------------------------------------------
echo ""
echo -e "${GREEN}${BOLD}=================================================================="
echo "          ✔ DEPLOYMENT COMPLETED SUCCESSFULLY!                    "
echo "==================================================================${NC}"
echo ""
echo -e "${CYAN}IMPORTANT NOTES FOR aaPanel / NGINX:${NC}"
echo -e "1. Make sure your site's ${BOLD}URL Rewrite${NC} in aaPanel is set to:"
echo -e "   ${YELLOW}location / {"
echo -e "       try_files \$uri \$uri/ /index.php?\$query_string;"
echo -e "   }${NC}"
echo ""
echo -e "2. Your website is ready at: ${BOLD}http://lifecare.innovacomputersbd.com${NC} (or https if SSL is active)"
echo ""
