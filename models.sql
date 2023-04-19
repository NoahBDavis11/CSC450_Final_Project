CREATE TABLE parkEvents ( 
    event_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    event_name VARCHAR(50) NOT NULL,
    event_start_date DATE NOT NULL, 
    event_end_date DATE NOT NULL, 
    event_description VARCHAR(400) NOT NULL); 

CREATE TABLE parkLocations ( 
    section_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    section_name VARCHAR(50) NOT NULL UNIQUE); 

CREATE TABLE Buildings (
    build_id INT NOT NULL AUTO_INCREMENT,
    max_occupancy INT NOT NULL,
    floor_size_sqft INT NOT NULL,
    section_id INT NOT NULL,
    PRIMARY KEY (build_id),
    FOREIGN KEY (section_id) REFERENCES Park_Locations(section_id));

CREATE TABLE Rides (
    ride_id INT NOT NULL AUTO_INCREMENT,
    ride_name VARCHAR(50) NOT NULL,
    ride_type VARCHAR(50),
    ride_open time NOT NULL,
    ride_close time NOT NULL,
    max_passengers INT NOT NULL,
    build_id INT,
    PRIMARY KEY (ride_id),
    FOREIGN KEY (build_id) REFERENCES Park_Locations(section_id),
    FOREIGN KEY (section_id) REFERENCES Buildings(build_id));

CREATE TABLE Rides_passenger_restrictions (
    ride_restrictions VARCHAR(50) NOT NULL,
    ride_id INT,
    PRIMARY KEY (ride_restrictions),
    FOREIGN KEY (ride_id) REFERENCES Rides(ride_id));
    
CREATE TABLE consessions
(
    cons_id	INT			PRIMARY KEY		AUTO_INCREMENT,
    cons_company_name	VARCHAR(50),
    cons_type 			VARCHAR(50),
    cons_open 			TIME			NOT NULL,
    cons_close 			TIME			NOT NULL, 
    cons_name 			VARCHAR(50)		NOT NULL,
    build_id 			INT,
    section_id 			INT			NOT NULL,
	FOREIGN KEY (build_id) REFERENCES
    	buildings(build_id),
    	FOREIGN KEY (section_id) REFERENCES
    	parkLocations(section_id)
	);
    
CREATE TABLE operate (
    ride_id INT NOT NULL,
    emp_id INT NOT NULL,
    PRIMARY KEY (ride_id),
    PRIMARY KEY (emp_id),
    FOREIGN KEY (ride_id) REFERENCES Rides(ride_id),
    FOREIGN KEY (emp_id) REFERENCES Employees(emp_id));

CREATE TABLE operate (
    cons_id INT NOT NULL,
    emp_id INT NOT NULL,
    PRIMARY KEY (cons_id),
    PRIMARY KEY (emp_id),
    FOREIGN KEY (cons_id) REFERENCES Concessions(cons_id),
    FOREIGN KEY (emp_id) REFERENCES Employees(emp_id));

CREATE TABLE host (
    emp_id INT NOT NULL,
    event_id INT NOT NULL,
    PRIMARY KEY (emp_id),
    PRIMARY KEY (event_id),
    FOREIGN KEY (emp_id) REFERENCES Employees(emp_id),
    FOREIGN KEY (event_id) REFERENCES Events(event_id));

CREATE TABLE resides (
    section_id INT NOT NULL,
    event_id INT NOT NULL,
    PRIMARY KEY (section_id),
    PRIMARY KEY (event_id),
    FOREIGN KEY (section_id) REFERENCES Park_Locations(section_id),
    FOREIGN KEY (event_id) REFERENCES Events(event_id));

CREATE TABLE occure_at (
    build_id INT NOT NULL,
    event_id INT NOT NULL,
    PRIMARY KEY (build_id),
    PRIMARY KEY (event_id),
    FOREIGN KEY (build_id) REFERENCES Buildings(build_id),
    FOREIGN KEY (event_id) REFERENCES Events(event_id));

CREATE TABLE employees ( emp_id INT PRIMARY KEY AUTO_INCREMENT, emp_FN varchar(50) not null, emp_LN varchar(50) not null, street_name_num varchar(75) not null, city varchar(30) not null, emp_state varchar(30) not null,zip varchar(10) not null,country varchar(30) not null,primary_phone varchar(10) not null,emp_role varchar(50) not null,wage int, date_hired date not null,email varchar(75) not null,salary int); 
