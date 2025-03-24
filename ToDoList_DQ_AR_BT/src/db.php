<?php
pg_connect("host=51.83.36.122
	        dbname=DB_Docker_RA_TB_QD 
	        user=dacque 
	        password=IRVb99 
	        port=5433");
pg_query("set names 'UTF8'");
pg_query("SET search_path TO todo_list");





/* à la maison :

http://localhost/phpmyadmin
login: root
passwd: 

Créer BD : table joke(idjoke, text, category)

*/