# Sessions

A Database-Session-Handler.  When you need to maintain a persistant user state across multiple servers/instances, a database-enabled session handler is required. Usage of this package assumes an installed MySQL database. 

Even though this package only requires a single table, its deployed as a unique database. I've found that abstracting session data from the application data model is beneficial when taking into account caching, replication, backups, etc. This can easily be changed if you need to.


## Installation and Configuration

Configuration is handled via a local.cfg file, like all other packages in this repository. The following config vars are required:


| Namespaced\Constant | Description | Default | Example |
| --------- | ----------- | ----------- | ----------- |
| ControlAltKaboom\Session]\DB_HOST | MySQL Database Host | not defined | "192.169.0.2" |
| ControlAltKaboom\Session]\DB_USER | MySQL Database UserName | not defined | "myUserName" |
| ControlAltKaboom\Session]\DB_PASS | MySQL Database Password | not defined | "p4ssw0rd" |
| ControlAltKaboom\Session]\DB_NAME | MySQL Database Name | "sessions" | "sessions" |
| ControlAltKaboom\Session]\DB_TABLE | MySQL Database Table | "sessions" | "sessions" |
| ControlAltKaboom\Session]\COOKIE_DOMAIN | php session cookie domain | not defined | ".domain.com" |

Setting the above constants in your local.cfg file and including the bootstrap.root/bootstrap.session will allow them to be parsed into the package automatically.

To install the required database and tables, run the following SQL:


```sql

# Create the database
CREATE DATABASE IF NOT EXISTS sessions 
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE sessions;

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL COMMENT 'session ID',
  `data` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'serialized session array',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

```




## Usage

Simply instantiate the object or as a singleton and call as needed.
