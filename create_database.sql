CREATE DATABASE IF NOT EXISTS sella_dauguen;
use sella_dauguen;

-- Create table of users
CREATE TABLE IF NOT EXISTS users
(
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    api_key VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

-- Create table of sites
CREATE TABLE IF NOT EXISTS sites
(
    id INT NOT NULL AUTO_INCREMENT,
    url VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

-- Create table of hitsory
CREATE TABLE IF NOT EXISTS history
(
    id INT NOT NULL AUTO_INCREMENT,
    site_id INT NOT NULL,
    update_time VARCHAR(255) NOT NULL,
    status INT NOT NULL,
    PRIMARY KEY (id)
);