# Generic Backup Script

A simple backup script written in bash, and easily tiggered via cron. It includes logging, cleanup/rotation, remote database connection and file compression. Its simple implementation is intended to allow for consistant and reliable backups.

## Installation

Installation is as simple as creating the backup directories, adding your app-specific configurations, and adding a cron-job for its execution.

1. Create Directories 
** Create Backup Root Directory 
** Create Application Storage Directory 
** Create Database Storage Directory 
2. Copy the [backup.sh](https://github.com/Control-Alt-Kaboom/ControlAltKaboom/blob/master/scripts/backup/backup.sh) executable to the backup root directory created above
3. Open up [backup.sh](https://github.com/Control-Alt-Kaboom/ControlAltKaboom/blob/master/scripts/backup/backup.sh) executable and edit the configuration options
4. Add a cron-job to run the script automatically

### 1.0 Creating The Backup Directories

You can create the backup directories anywhere you wish, but for the purpose of this document, we're going to use '/root/backups'. You should also go ahead and create the storage locations for both the application and database. They do not need to be different, but it makes sense to keep them separate.

```
[$:/] mkdir /root/backups
[$:/] mkdir /root/backups/web
[$:/] mkdir /root/backups/database
```

### 2.0 Copy The Backup Executable To The Backup Root Directory

> **Important Note:**
> If you choose to symlink the executable rather than a direct copy, if you pull updates from the remote repository, they will overwrite your configuration settings. You should always do a direct copy, and manually merge in updates when required.

Simply copy the executable to the backup root directory you just created. The file should be executable only by the user/process that is going to call it. This install example assumes the backup process will be run as root

```
[$:/] cp ./backup.sh /root/backups
[$:/] chmod 700 /root/backups/backup.sh
```

### 3.0 Configuration

Open up the [backup.sh](https://github.com/Control-Alt-Kaboom/ControlAltKaboom/blob/master/scripts/backup/backup.sh) in your favorite editor and update the following variables.

* **DB_HOST**: Enter the hostname/ip-address of the database server. If its running on the localhost, then simply enter "localhost"
* **DB_USER**: Enter the username of the database-user with fill privileges. The user is required to have privilegs on all the databases that you enable backups for. 
* **DB_PASS**: Enter the password for the user entered above.
* **DB_PATH**: Enter the path where you want the db-files to be stored. It should be the directory you created in the above step. The script will create sub-directories by date for each of the backups it generates. You only need to enter the parent directory. Example: /root/backups/db
* **DB_LIST**: For each of the databases you want backed up, add its name here. The list should be enclosed in brackets, and items deliminated by spaces.
* **APP_PATH**: Enter the path where you want the app-files to be stored. It should be the directory you created in the above step. The script will create sub-directories by date for each of the backups it generates. You only need to enter the parent directory. Example: /root/backups/app
* **DB_LIST**: For each of the directories you want backed up, add its name here. The list should be enclosed in brackets, and items deliminated by spaces. For readability, you can place items on new lines ( but make sure to include the deliminating space )
* **BACKUP_LOG**: Enter the path and file name where you want the log to be stored. It should be the root directory you created in the above step. This file will automatically be created for you by the script.
* **BACKUP_DATE**: If you wish to change the format of the date, you can do so here. Otherwise just leave it as is.
* **BACKUP_STORAGE**: Enter the amount of days you would like to keep backups for. This will delete anything that was modified later than that date. For Example, if you want to keep 7 days of backups, enter "+6". For more indepth rotation, use logrotate.
* **DEBUG_MODE**: (TRUE/FALSE) When set to 'TRUE', backups will still be created, but it will output to the screen rather than the log file. After you know its configured correctly, make sure to set this to FALSE.

### 4.0 Enabling Via CRON 

To enable the backup process to be run automatically, the best way is to simply create a cron-job. More information on how to use cron can be found [here](http://man7.org/linux/man-pages/man5/crontab.5.html) [and here](https://en.wikipedia.org/wiki/Cron)

Example: (Run every day at 04:20)

```
20  4 * * * /root/backups/backup.sh > /dev/null 2>&1
```


# Processing Options / Configuration

At the bottom of the script there is a list of commands that the script will execute. If you do not need filesystem, or database backups, simple comment out the lines for the applicable process calls. You can also enable clearing of the log file this way.


# Future Releases

While there is no expected release date, the next release will include the following:

* Mounting and Management of Remote Filesystems
* SSH Auto-Authentication
* Multi-Server Processing Options
* Online-Service Support
* Email Alerts 
* External Configuration ( So the libraries themselves can be linked to a repo. )

