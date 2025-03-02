# absen

Aplikasi Absen Guru

CREATE USER 'leub2483*absensi'@'localhost' IDENTIFIED BY 'Mundingan11!';
GRANT ALL PRIVILEGES ON * . \_ TO 'leub2483_absensi'@'localhost';
FLUSH PRIVILEGES;

CREATE DATABASE leub2483_absensi;

sudo nano /etc/apache2/apache2.conf | override All
sudo a2enmod rewrite
sudo systemctl restart apache2.service

Create:
sudo nano /etc/apache2/sites-available/absen.conf
add:
<VirtualHost \*:80>
ServerAdmin webmaster@localhost
ServerName your_domain
ServerAlias www.absen.com
DocumentRoot /var/www/html/absen
ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

Switch:
sudo a2ensite absen.conf
sudo a2dissite 000-default.conf
