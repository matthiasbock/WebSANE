#!/bin/sh
mkdir -p /etc/apache2/conf.d
mkdir -p /etc/sanewi
mkdir -p /usr/share/doc/sanewi
mkdir -p /var/log/sanewi
mkdir -p /var/www/sanewi
cp -Rf etc/apache2/conf.d/* /etc/apache2/conf.d
cp -Rf etc/sanewi/* /etc/sanewi
cp -Rf usr/share/doc/sanewi/* /usr/share/doc/sanewi
#cp -Rf var/log/sanewi/* /var/log/sanewi
cp -Rf var/www/sanewi/* /var/www/sanewi
chmod 644 -R /etc/sanewi /usr/share/doc/sanewi /var/log/sanewi
chmod 744 -R /var/www/sanewi
chmod 744  /etc/sanewi /usr/share/doc/sanewi /var/log/sanewi
chmod 744  /var/www/sanewi
chown www-data -R /var/www/sanewi /var/log/sanewi /etc/sanewi 
a2enmod php5
echo "Please restart Apache2 in order to activate Sane WI"
echo "Once activate, open a browser and enter http://localhost/sane"
exit 0
