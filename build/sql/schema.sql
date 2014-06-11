
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- benutzer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `benutzer`;

CREATE TABLE `benutzer`
(
    `bname` VARCHAR(8) NOT NULL,
    `passwort` VARCHAR(8) NOT NULL,
    `istAdmin` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`bname`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- jahrgang
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `jahrgang`;

CREATE TABLE `jahrgang`
(
    `jbez` VARCHAR(6) NOT NULL,
    PRIMARY KEY (`jbez`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- raum
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `raum`;

CREATE TABLE `raum`
(
    `rnr` VARCHAR(6) NOT NULL,
    `hatbeamer` TINYINT(1) DEFAULT 1,
    `jbez` VARCHAR(6) NOT NULL,
    PRIMARY KEY (`rnr`),
    INDEX `raum_FI_1` (`jbez`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
