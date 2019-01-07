CREATE TABLE users(
	user_id SMALLINT NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(20) NOT NULL,
	last_name VARCHAR(20) NOT NULL,
	email VARCHAR(20) NOT NULL,
	password_hash VARCHAR(255) NOT NULL,
	CONSTRAINT PRIMARY KEY(user_id)
);

CREATE TABLE parking(
	parking_id SMALLINT NOT NULL AUTO_INCREMENT,
	parking_name VARCHAR(20) NOT NULL,
	latitude DOUBLE NOT NULL,
	longitude DOUBLE NOT NULL,
	price DOUBLE NOT NULL,
	parking_description VARCHAR(255),
	rating DOUBLE,
	CONSTRAINT PRIMARY KEY(parking_id)
);

CREATE TABLE reviews(
	review_id SMALLINT NOT NULL AUTO_INCREMENT,
	parking_id SMALLINT NOT NULL,
	rating DOUBLE NOT NULL,
	review_description VARCHAR (255),
	CONSTRAINT PRIMARY KEY(review_id),
	FOREIGN KEY(parking_id) REFERENCES parking(parking_id)
);
