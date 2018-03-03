# Création d'un alias TP dans Apache
- ouvrir le fichier httpd.conf
- ajouter un alias TP correspondant au chemin du répertoire web dans le système.
```Apache
#exemple 
Alias /TP c:/wamp/www/airazur/Air-Azur/web
#
<Directory "c:/wamp/www/airazur/Air-Azur/web">
    AllowOverride All
    Options None
    Require all granted
</Directory> 
```
- sauver et redémarrer Apache