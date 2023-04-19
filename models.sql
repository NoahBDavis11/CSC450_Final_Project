CREATE TABLE parkEvents ( 
    event_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    event_name VARCHAR(50) NOT NULL,
    event_start_date DATE NOT NULL, 
    event_end_date DATE NOT NULL, 
    event_description VARCHAR(400) NOT NULL); 

CREATE TABLE Locations ( 
    section_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    section_name VARCHAR(50) NOT NULL UNIQUE); 

CREATE TABLE buildings (
    build_id INT NOT NULL AUTO_INCREMENT,
    max_occupancy INT NOT NULL,
    floor_size_sqft INT NOT NULL,
    section_id INT NOT NULL,
    PRIMARY KEY (build_id),
    FOREIGN KEY (section_id) REFERENCES parkLocations(section_id));

CREATE TABLE rides (
    ride_id INT NOT NULL AUTO_INCREMENT,
    ride_name VARCHAR(50) NOT NULL,
    ride_type VARCHAR(50),
    ride_open time NOT NULL,
    ride_close time NOT NULL,
    max_passengers INT NOT NULL,
    build_id INT,
    section_id INT NOT NULL,
    PRIMARY KEY (ride_id),
    FOREIGN KEY (build_id) REFERENCES parkLocations(section_id),
    FOREIGN KEY (section_id) REFERENCES buildings(build_id));

CREATE TABLE passengerRestrictions (
    ride_restrictions VARCHAR(50) NOT NULL,
    ride_id INT,
    PRIMARY KEY (ride_restrictions),
    FOREIGN KEY (ride_id) REFERENCES rides(ride_id));
    
CREATE TABLE parkConsessions
(
    cons_id	INT			PRIMARY KEY		AUTO_INCREMENT,
    cons_company_name	VARCHAR(50),
    cons_type 			VARCHAR(50),
    cons_open 			TIME			NOT NULL,
    cons_close 			TIME			NOT NULL, 
    cons_name 			VARCHAR(50)		NOT NULL,
    build_id 			INT,
    section_id 			INT				NOT NULL,
	FOREIGN KEY (build_id) REFERENCES
    	Buildings(build_id),
    FOREIGN KEY (section_id) REFERENCES
    	parkLocations(section_id)
	);
    
CREATE TABLE employees_rides_operates  (
    ride_id INT NOT NULL,
    emp_id INT NOT NULL,
    PRIMARY KEY (ride_id, emp_id),
    FOREIGN KEY (ride_id) REFERENCES rides(ride_id),
    FOREIGN KEY (emp_id) REFERENCES employees(emp_id));

CREATE TABLE employees_concessions_operate (
    cons_id INT NOT NULL,
    emp_id INT NOT NULL,
    PRIMARY KEY (cons_id, emp_id),
    FOREIGN KEY (cons_id) REFERENCES concessions(cons_id),
    FOREIGN KEY (emp_id) REFERENCES employees(emp_id));

CREATE TABLE employees_parkEvents_host  (
    emp_id INT NOT NULL,
    event_id INT NOT NULL,
    PRIMARY KEY (emp_id),
    PRIMARY KEY (event_id),
    FOREIGN KEY (emp_id) REFERENCES employees(emp_id),
    FOREIGN KEY (event_id) REFERENCES parkEvents(event_id));

CREATE TABLE parkEvents_parkLocations_resides (
    section_id INT NOT NULL,
    event_id INT NOT NULL,
    PRIMARY KEY (section_id, event_id),
    FOREIGN KEY (section_id) REFERENCES parkLocations(section_id),
    FOREIGN KEY (event_id) REFERENCES parkEvents(event_id));

CREATE TABLE parkEvents_buildings_occureAt_at (
    build_id INT NOT NULL,
    event_id INT NOT NULL,
    PRIMARY KEY (build_id, event_id),
    FOREIGN KEY (build_id) REFERENCES buildings(build_id),
    FOREIGN KEY (event_id) REFERENCES parkEvents(event_id));

CREATE TABLE employees_repairs_perform (
    emp_id INT NOT NULL,
    rep_num INT NOT NULL,
    ride_id INT NOT NULL,
    PRIMARY KEY (emp_id, rep_num, ride_id),
    FOREIGN KEY (emp_id) REFERENCES employees(emp_id),
    FOREIGN KEY (rep_num) REFERENCES repairs(rep_num),
    FOREIGN KEY (ride_id) REFERENCES repairs(ride_id));

CREATE TABLE employees ( emp_id INT PRIMARY KEY AUTO_INCREMENT, emp_FN varchar(50) not null, emp_LN varchar(50) not null, street_name_num varchar(75) not null, city varchar(30) not null, emp_state varchar(30) not null,zip varchar(10) not null,country varchar(30) not null,primary_phone varchar(10) not null,emp_role varchar(50) not null,wage int, date_hired date not null,email varchar(75) not null,salary int);



Create table repairs(rep_num INT NOT NULL AUTO_INCREMENT, ride_id INT NOT NULL, rep_company_name varchar(50), rep_start_date date NOT NULL, rep_fin_date date NOT NULL, rep_description varchar(400) not null, total_cost int not null, primary key (rep_num , ride_id), foreign key (ride_id) references rides(ride_id))
