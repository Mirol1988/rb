#!/bin/bash -e

[[ -z "$MIGRATIONS" ]] || { echo "Migrations.."; php ./console.php migrate --interactive=0 ; }
printenv | grep -v 'MARIADB_HOST|MARIADB_PORT|MARIADB_DATABASE|MARIADB_USER|MARIADB_PASSWORD|REDIS_HOST|REDIS_PORT|REDIS_INDEX|TELEGRAM_TOKEN|SCRAM_URL|IP|PORT|USERNAME|PASSWORD' > /etc/environment
#cron
