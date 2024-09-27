CREATE TABLE `conditions` (
  `c_id` bigint(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `d_id` bigint(20) NOT NULL,
  `c_countries` varchar(500) DEFAULT null,
  `c_profituse` text DEFAULT null,
  `c_broadresearchuse` varchar(500) DEFAULT null,
  `c_specificresearchuse` varchar(500) DEFAULT null,
  `c_reconenct` text DEFAULT null
);

CREATE TABLE `dataset` (
  `d_id` bigint(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `u_id` bigint(20) NOT NULL,
  `d_uniqueid` varchar(500) DEFAULT null,
  `d_title` text NOT NULL,
  `d_abstract` text NOT NULL,
  `d_theme` text DEFAULT null,
  `d_researchstudy` text NOT NULL,
  `d_datatypes` varchar(500) NOT NULL,
  `d_ethnicities` varchar(1000) DEFAULT null,
  `d_funders` varchar(1000) DEFAULT null,
  `d_geographies` varchar(1000) DEFAULT null,
  `d_keywords` varchar(1000) NOT NULL,
  `d_agerange` varchar(500) DEFAULT null,
  `d_studysize` int(11) NOT NULL,
  `d_controler` varchar(5000) NOT NULL,
  `d_arights` varchar(1000) NOT NULL,
  `d_legaljurisdiction` varchar(1000) NOT NULL,
  `d_organisation` text NOT NULL,
  `d_conpoint` varchar(100) NOT NULL,
  `d_approved` tinyint(1) NOT NULL,
  `d_rejected` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT (current_timestamp()),
  `modified_at` datetime NOT NULL DEFAULT (current_timestamp()),
  `d_hdrconsent` tinyint(1) NOT NULL,
  `d_revisions` bigint(20) NOT NULL
);

CREATE TABLE `link` (
  `l_id` bigint(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `u_id` bigint(20) NOT NULL,
  `l_token` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT (current_timestamp())
);

CREATE TABLE `person` (
  `p_id` bigint(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `d_id` bigint(20) NOT NULL,
  `p_title` varchar(250) NOT NULL,
  `p_firstname` varchar(50) NOT NULL,
  `p_surname` varchar(250) NOT NULL,
  `p_email` varchar(50) NOT NULL,
  `p_affiliations` varchar(5000) NOT NULL
);

CREATE TABLE `publications` (
  `pub_id` bigint(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `d_id` bigint(20) NOT NULL,
  `pub_title` varchar(250) NOT NULL,
  `pub_venue` varchar(500) NOT NULL,
  `pub_date` int(11) NOT NULL,
  `pub_author` varchar(250) NOT NULL,
  `pub_doi` varchar(1000) DEFAULT null
);

CREATE TABLE `revisions` (
  `id` bigint(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `d_id` bigint(20) NOT NULL,
  `r_no` bigint(20) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT (current_timestamp()),
  `old_values` longtext NOT NULL
);

CREATE TABLE `userinfo` (
  `u_id` bigint(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `u_fname` varchar(500) NOT NULL,
  `u_lname` varchar(500) NOT NULL,
  `u_email` varchar(500) NOT NULL,
  `u_role` varchar(1000) NOT NULL
);

CREATE INDEX `d_id` ON `conditions` (`d_id`);

CREATE INDEX `d_id` ON `person` (`d_id`);

CREATE INDEX `d_id` ON `publications` (`d_id`);

ALTER TABLE `conditions` ADD CONSTRAINT `conditions_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `dataset` (`d_id`);

ALTER TABLE `person` ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `dataset` (`d_id`);

ALTER TABLE `publications` ADD CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `dataset` (`d_id`);

ALTER TABLE `revisions` ADD FOREIGN KEY (`d_id`) REFERENCES `dataset` (`d_id`);

ALTER TABLE `dataset` ADD FOREIGN KEY (`u_id`) REFERENCES `userinfo` (`u_id`);

ALTER TABLE `link` ADD FOREIGN KEY (`u_id`) REFERENCES `userinfo` (`u_id`);
