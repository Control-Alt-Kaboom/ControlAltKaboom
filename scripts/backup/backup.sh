#!/bin/bash
# --------------------------------------------------------------------------------------------------
# -=- Generic Backup Script with logging for both filesystem and mysql database
# 
# Documentation:  see README.md
# Sources: http://www.github.com/Control-Alt-Kaboom/Control-Alt-Kaboom/scripts/backup 
#
# --------------------------------------------------------------------------------------------------



DB_HOST="000.000.000.000"
DB_USER="YOUR_DB_USERNAME"
DB_PASS="YOUR_DB_PASSWORD"
DB_PATH="/your/backup/storage/path/db"
DB_LIST=(YourDatabaseName1 YourDatabaseName2 YourDatabaseName3)

APP_PATH="/your/backup/storage/path/app"
APP_LIST=(
  /your/path/to/backup/src/1 
  /your/path/to/backup/src/2
  /another/path/you/want/backed/up/src/1 
  /another/path/you/want/backed/up/src/2 
)

BACKUP_DATE=$(date +"%Y%m%d") 
BACKUP_LOG="/your/path/to/backup.log"

# How many days we store ( Default "+6" - stores files up to 7 days
BACKUP_STORAGE="+6"



DEBUG_MODE="false"

[ -n "$DB_HOST" ] && ARGS="$ARGS -h$DB_HOST"
[ -n "$DB_USER" ] && ARGS="$ARGS -u$DB_USER"
[ -n "$DB_PASS" ] && ARGS="$ARGS -p$DB_PASS"

umask 0027


# --------------------------------------------------------------------------------------------------
# Functions - Logging
# --------------------------------------------------------------------------------------------------

logClear(){
  if [[ "$DEBUG_MODE" == "true" ]];then
    echo $(logLine)
    echo "["`date +%F\ %T`"] Starting New Log File"
    echo $(logLine)
  else
    echo $(logLine) > $BACKUP_LOG
    echo "["`date +%F\ %T`"] Starting New Log File" >> $BACKUP_LOG	
    echo $(logLine) >> $BACKUP_LOG
  fi
}	

logStart(){
  if [[ "$DEBUG_MODE" == "true" ]];then
    echo $(logLine)
    echo "["`date +%F\ %T`"] Starting Backup Routine"
    echo $(logLine)
  else
    echo $(logLine) >> $BACKUP_LOG
    echo "["`date +%F\ %T`"] Starting Backup Routine" >> $BACKUP_LOG	
    echo $(logLine) >> $BACKUP_LOG
  fi
}	

logWrite(){
  if [[ "$DEBUG_MODE" == "true" ]];then
    echo "["`date +%F\ %T`"] $1"
  else
    echo "["`date +%F\ %T`"] $1" >> $BACKUP_LOG	
  fi
}

logLine(){
  printf -- '-%.s' {1..100} ; echo
}


# --------------------------------------------------------------------------------------------------
# Functions - Backup Processes
# --------------------------------------------------------------------------------------------------

createDatabaseBackupDirectory(){
  logWrite "Creating Backup Directory: $DB_PATH/$BACKUP_DATE"
  mkdir -p "$DB_PATH/$BACKUP_DATE"
}
createApplicationBackupDirectory(){
  logWrite "Creating Backup Directory: $APP_PATH/$BACKUP_DATE"
  mkdir -p "$APP_PATH/$BACKUP_DATE"
}

cleanupOldBackups(){
  logWrite "Cleanup - removing all DATABASE backups $BACKUP_STORAGE days from today"
  find "$DB_PATH" -mindepth 1 -a -type d -mtime "$BACKUP_STORAGE" -print0 | xargs -0r rm -rfv >> $BACKUP_LOG

  logWrite "Cleanup - removing all APPLICATION backups $BACKUP_STORAGE days from today"
  find "$APP_PATH" -mindepth 1 -a -type d -mtime "$BACKUP_STORAGE" -print0 | xargs -0r rm -rfv >> $BACKUP_LOG
}

createDatabaseBackups(){
  for i in ${DB_LIST[@]}; do

    logWrite "$i - creating data dump"
    mysqldump $ARGS $i > $DB_PATH/$BACKUP_DATE/$i.complete.sql
	
    logWrite "$i - compressing output"
    gzip -9fq $DB_PATH/$BACKUP_DATE/$i.complete.sql

    logWrite "$i - done"
  
  done
}

createApplicationBackups(){
  for i in ${APP_LIST[@]}; do
    NAME=${i##*/}
	  logWrite "$i - creating compressed app dump: $NAME.tgz"
    tar -cf $APP_PATH/$BACKUP_DATE/$NAME.tgz $i
    logWrite "$i - done"
  done
}


# --------------------------------------------------------------------------------------------------
# Process
# --------------------------------------------------------------------------------------------------

#logClear
logStart
cleanupOldBackups
createDatabaseBackupDirectory
createApplicationBackupDirectory
createApplicationBackups
createDatabaseBackups

logWrite "-- Done"
exit 0
