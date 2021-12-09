#!/bin/bash

#cette ligne éteint et supprime le container si il est déjà lancé
docker stop sti_project || true && docker rm sti_project || true

#Cette commande permet de télécharger l’image docker nécessaire au bon fonctionnement du site, puis de lancer un container avec cette image.
#Si un service tourne déjà sur le port 8080, vous pouvez sans autre le modifier.
docker run -ti -d -p 8080:80 --name sti_project --hostname sti arubinst/sti:project2018

#ces lignes lancent les services web et php
docker exec -u root sti_project service nginx start
docker exec -u root sti_project service php5-fpm start

#ces deux lignes permettent de copier le contenu du site dans le container.
docker cp ./site/html sti_project:/usr/share/nginx
docker cp ./site/databases sti_project:/usr/share/nginx

#ajoute les droits nécessaire pour la modification de la base de données.
docker exec -u root sti_project bash -c 'chmod 777 /usr/share/nginx/databases/database.sqlite'
docker exec -u root sti_project bash -c 'chmod 777 /usr/share/nginx/databases'