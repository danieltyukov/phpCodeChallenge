-- - Persons must be stored.
-- - Cars must be stored.
-- - A person has a first name and a last name. Together these identify the person.
-- - A car has a license plate.
-- - Some persons own cars.
-- - Persons may even own multiple cars.
-- - There are different types of cars: sedans and trucks.


CREATE TABLE persons
(
    id INTEGER PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255)
);

CREATE TABLE cars
(
    id INTEGER PRIMARY KEY,
    brand_id INTEGER,
    license_plate VARCHAR(255),
    car_type VARCHAR(255),
    FOREIGN KEY (brand_id) REFERENCES brands(id)
);

CREATE TABLE car_ownerships
(
    id INTEGER PRIMARY KEY,
    person_id INTEGER,
    car_id INTEGER,
    FOREIGN KEY(person_id) REFERENCES persons(id),
    FOREIGN KEY(car_id) REFERENCES cars(id)
);



-- - A car has a brand. Examples: ‘Toyota’, ‘Opel’.
-- - A car has a brand type. Examples: ‘Corolla’, ‘Corsa’.
-- - Truck brand types must store a loading capacity.
-- - Sedan brand types must store the passenger capacity.


CREATE TABLE brands
(
    id INTEGER PRIMARY KEY,
    brand_name VARCHAR(255)
);

CREATE TABLE brand_types
(
    id INTEGER PRIMARY KEY,
    brand_id INTEGER,
    brand_type_name VARCHAR(255),
    FOREIGN KEY(brand_id) REFERENCES brands(id)
);

CREATE TABLE truck_brand_types
(
    id INTEGER PRIMARY KEY,
    brand_type_id INTEGER,
    loading_capacity INTEGER,
    FOREIGN KEY(brand_type_id) REFERENCES brand_types(id)
);

CREATE TABLE sedan_brand_types
(
    id INTEGER PRIMARY KEY,
    brand_type_id INTEGER,
    passenger_capacity INTEGER,
    FOREIGN KEY(brand_type_id) REFERENCES brand_types(id)
);


--SAMPLE DATA

INSERT INTO persons
    (first_name, last_name)
VALUES
    ('John', 'Doe');


INSERT INTO brand_types
    (brand_id, brand_type_name)
VALUES
    (1, 'Corolla');

INSERT INTO sedan_brand_types
    (brand_type_id, passenger_capacity)
VALUES
    (1, 4);


INSERT INTO cars
    (license_plate, brand_id, car_type)
VALUES
    ('ABC-123', 1, 'sedan');


INSERT INTO car_ownerships
    (person_id, car_id)
VALUES
    (1, 1);
