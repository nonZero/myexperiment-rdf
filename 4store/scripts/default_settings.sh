#!/bin/bash
## @file 4store/scripts/default_settings.sh
## @brief Default settings file providing parameters for bash scripts in the 4store/scripts directory.
## @author David R Newman
## @version beta
## @details This script is the default variables to be exported for use by bash scripts in the 4store/scripts directory.  A copy of this should be taken to produce 4store/scripts/settings.sh that can then be configured for individual instances.

export PKG_CONFIG_PATH="/usr/lib64/pkgconfig:/usr/share/pkgconfig:/usr/local/lib/pkgconfig:/usr/local/share/pkgconfig"
export LD_PATH="/var/linkeddata"
export LD_LIBRARY_PATH="/usr/local/lib"
export BACKUP_USER="backup"
export BACKUP_SERVER="myexperiment.example.org"
export MYSQL_BACKUP_LOCATION="mysql/latest.sql.gz"
export MYSQL_USERNAME="root"
export MYSQL_PASSWORD=""
export MYSQL_HOST=""
export MYSQL_DATABASE="myexperiment"
export STORE4_PATH="$LD_PATH/4store"
export STORE4EXEC_PATH="/usr/local/bin"
export STORE4LIB_PATH="$STORE4_PATH/lib"
export DATA_PATH="$LD_PATH/data"
export HTTPRDF_PATH="http://rdf.myexperiment.org"
export HTTPWWW_PATH="http://www.myexperiment.org"
export HTTPSPEC_PATH="http://rdf.myexperiment.org"
export PHPEXEC_PATH="/usr/bin"
export BANG='!'
export TRIPLESTORE="myexp_ld"
export HTTPGROUP="apache"
export JAVA_CP=".:$STORE4LIB_PATH/jena.jar:$STORE4LIB_PATH/iri.jar:$STORE4LIB_PATH/arq.jar:$STORE4LIB_PATH/xercesImpl.jar:$STORE4LIB_PATH/xml-apis.jar:$STORE4LIB_PATH/icu4j_3_4.jar:$STORE4LIB_PATH/json.jar:$STORE4LIB_PATH/concurrent.jar:$STORE4LIB_PATH/antlr-2.7.5.jar:$STORE4LIB_PATH/junit.jar:$STORE4LIB_PATH/log4j-1.2.12.jar:$STORE4LIB_PATH/wstx-asl-3.0.0.jar:$STORE4LIB_PATH/stax-api-1.0.jar:$STORE4LIB_PATH/mysql-connector-java-5.0.8-bin.jar:$STORE4LIB_PATH/commons-logging-1.1.1.jar:$STORE4LIB_PATH/commons-logging-1.1.1-javadoc.jar:$STORE4LIB_PATH/commons-logging-1.1.1-sources.jar:$STORE4LIB_PATH/commons-logging-adapters-1.1.1.jar:$STORE4LIB_PATH/commons-logging-api-1.1.1.jar:$STORE4LIB_PATH/commons-logging-tests.jar:$STORE4LIB_PATH/axis.jar:$STORE4LIB_PATH/bcpg-jdk15-139.jar:$STORE4LIB_PATH/bcprov-jdk15-139.jar:$STORE4LIB_PATH/commons-lang-2.0.jar:$STORE4LIB_PATH/grddl.jar:$STORE4LIB_PATH/hsqldb-1.8.0.7.jar:$STORE4LIB_PATH/jakarta-oro-2.0.5.jar:$STORE4LIB_PATH/nekohtml.jar:$STORE4LIB_PATH/ng4j.jar:$STORE4LIB_PATH/saxon8.jar:$STORE4LIB_PATH/tagsoup-1.0.4.jar:"
export ENTITIES=( announcements attributions citations comments content_types creditations experiments favourites files friendships groups group_announcements jobs licenses local_pack_entries memberships messages packs policies ratings remote_pack_entries reviews runners tags taggings users vocabularies workflows workflow_versions dataflows )
export LC_ALL=C
export LANG=en_GB.UTF-8

