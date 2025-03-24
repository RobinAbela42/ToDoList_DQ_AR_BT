<?php
pg_connect("host=localhost 
	        dbname=barryt 
	        user=barryt 
	        password=26XsF2 
	        port=5433");
pg_query("set names 'UTF8'");
pg_query("SET search_path TO barryt");





/* à la maison :

http://localhost/phpmyadmin
login: root
passwd: 

Créer BD : table joke(idjoke, text, category)

*/