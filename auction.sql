DROP DATABASE IF EXISTS auction;
CREATE DATABASE auction
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
USE auction;
SET SESSION sql_mode='ALLOW_INVALID_DATES' ;
SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  email CHAR(255) NOT NULL,
  name CHAR(255) NOT NULL,
  password VARCHAR(255),
  user_status INT(3),
  express_tour_flag INT(3) DEFAULT 0
);

CREATE TABLE user_data (
  id INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  user_id INT,
  data VARCHAR(255)
);

CREATE TABLE applicant(
  id INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  car_mark VARCHAR(255) NOT NULL,
  car_model VARCHAR(255) NOT NULL,
  year_of_make YEAR NOT NULL,
  mileage INT,
  gearbox VARCHAR(10) NOT NULL,
  fuel_type VARCHAR(10),
  engine_capacity INT,
  engine_volume INT,
  description TEXT(1024),
  region VARCHAR(255),
  lot_data DATETIME,
  lot_data_time DATE,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  ending_time_marker INT DEFAULT 1,
  recommended_bet_step INT,
  desired_price INT
);

CREATE TABLE car_photos (
  application_id INT,
  FOREIGN KEY (application_id) REFERENCES applicant(id),
  image VARCHAR(100),
  num INT
);

CREATE TABLE bet(
  id INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  lot_id INT,
  FOREIGN KEY (lot_id) REFERENCES applicant(id),
  user_id INT,
  bet_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  bet_sum INT
);

CREATE TABLE express_tour_general (
  id INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  lot_id INT,
  FOREIGN KEY (lot_id) REFERENCES applicant(id),
  time_start TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  current_stage_time_start TIMESTAMP,
  max_bet INT,
  stage_number INT,
  finish_marker INT DEFAULT 0,
  won_user_id INT
);

CREATE TABLE express_tour_bet (
  id INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  tour_id INT,
  FOREIGN KEY(tour_id) REFERENCES express_tour_general(id),
  bet_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  user_id INT,
  stage_number INT,
  bet_sum INT
);

CREATE TABLE express_tour_user (
  id INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  tour_id INT,
  user_id INT,
  lot_id INT
);

CREATE TABLE user_won_lots (
  id INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES user(id),
  applicant_id INT
);