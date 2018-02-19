
CREATE DATABASE IF NOT EXISTS vitalstatistix;

USE vitalstatistix;

CREATE TABLE IF NOT EXISTS huts (
	-- id INT(9) UNSIGNED AUTO_INCREMENT,
	unit_number VARCHAR(5) NOT NULL,
	discount INT(4) DEFAULT 0 NOT NULL,
	rate_per_sqft INT(4) NOT NULL,
	built_up_area INT(9) NOT NULL,
	floor INT(2) NOT NULL,
	block VARCHAR(2) NOT NULL,
	basic_cost INT(9) NOT NULL,
	floor_rise INT(6) NOT NULL,
	grand_total DECIMAL(11,2) NOT NULL,
	-- PRIMARY KEY ( id ),
	CONSTRAINT unique_entry UNIQUE ( unit_number, discount, rate_per_sqft, built_up_area, floor, block, basic_cost, floor_rise, grand_total )
);
