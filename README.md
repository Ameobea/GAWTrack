GAWTrack
========

Events history tracker for GAW cloud miners.

If you want to clone this on your own, everything should be pre-configured except one thing.  You'll have to create a file called "const.php" in modules/login with the follwing structure:

```php
<?php

class Passwords {
 const DB_USERNAME = "username";
 const DB_PASSWORD = "password";
 const DB_DATABASE = "gawtrack"; //has to be gawtrack due to several hardcoded queries.
 const DB_IP = "localhost";
}

?>
```

Here's the MySQL create code for the only table that should be in that database, named events:

```SQL
CREATE TABLE `events` (
 `id` int(6) NOT NULL AUTO_INCREMENT,
 `username` tinytext NOT NULL,
 `date` timestamp NULL DEFAULT NULL,
 `type` tinytext NOT NULL,
 `data` text NOT NULL,
 `uid` varchar(24) NOT NULL,
 `pass` varchar(100) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=115707 DEFAULT CHARSET=latin1
```
