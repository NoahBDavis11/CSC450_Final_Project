CREATE TABLE parkEvents ( event_id INT PRIMARY KEY AUTO_INCREMENT, event_name VARCHAR(50) NOT NULL,event_start_date DATE NOT NULL, event_end_date DATE NOT NULL, event_description VARCHAR(400) NOT NULL); 

CREATE TABLE parkLocations ( section_id INT PRIMARY KEY AUTO_INCREMENT, section_name VARCHAR(50) NOT NULL UNIQUE); 
