<?php

if (!defined("S3_BUCKET")) {
    define("S3_BUCKET", "");
}

if (!defined("S3_BUCKET_URL")) {
    define("S3_BUCKET_URL", "");
}

// http://".S3_BUCKET.".s3.amazonaws.com/
if (!defined("COFIG_FRONT_NAME")) {
    define("COFIG_FRONT_NAME", "/advance-project-analytics/");
}

if (!defined("COFIG_ADMIN_NAME")) {
    define("COFIG_ADMIN_NAME", "/advance-project-analytics/admin/");
}

if (!defined("COFIG_SITE_NAME")) {
    define("COFIG_SITE_NAME", "Advance Analytics App");
}

if (!defined("COFIG_UPLOAD_PATH")) {
    define("COFIG_UPLOAD_PATH", "/advance-project-analytics/upload/");
}

if (!defined("COFIG_DB_NAME")) {
    define("COFIG_DB_NAME", "uyt");
}

if (!defined("COFIG_DB_PWD")) {
    define("COFIG_DB_PWD", 'Admin@123');
}

if (!defined("COFIG_DB_USR")) {
    define("COFIG_DB_USR", "admin");
}

if (!defined("COFIG_DB_HST")) {
    define("COFIG_DB_HST", "localhost");
}

if (!defined("COFIG_SITE_URL")) {
    define("COFIG_SITE_URL", "http://vrinsoft.com/project-analytics/");
}

if (!defined("COFIG_API_URL")) {
    define("COFIG_API_URL", "http://vrinsoft.com/project-analytics/api/");
}

if (!defined("COFIG_FILE_UPLOAD_PATH")) {
    define("COFIG_FILE_UPLOAD_PATH", $_SERVER['DOCUMENT_ROOT']."/advance-project-analytics/upload/");
}

if (!defined("COFIG_SITE_URL_IMG")) {
    define("COFIG_SITE_URL_IMG", "http://vrinsoft.com/project-analytics/upload/");
}