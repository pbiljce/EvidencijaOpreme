/*Brisanje baze "EquipmentEvidence" ukoliko je već kreirana*/
DROP DATABASE IF EXISTS EquipmentEvidence;

/*Kreiranje baze "EquipmentEvidence" za elektronsku evidenciju računarske opreme*/
CREATE DATABASE EquipmentEvidence CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE EquipmentEvidence;

/*Kreiranje tabele za tip opreme */
CREATE TABLE equiptype(
	equiptype_id INT PRIMARY KEY AUTO_INCREMENT, 
    equiptype VARCHAR(50) NOT NULL
) ENGINE=INNODB;

/*Kreiranje tabele za proizvođača opreme */
CREATE TABLE equipproducer(
	equipproducer_id INT PRIMARY KEY AUTO_INCREMENT, 
    equipproducer VARCHAR(50) NOT NULL
) ENGINE=INNODB;

/*Kreiranje tabele za status opreme */
CREATE TABLE equipstatus(
	equipstatus_id INT PRIMARY KEY AUTO_INCREMENT, 
    equipstatus VARCHAR(20) NOT NULL 
) ENGINE=INNODB;

/*Kreiranje tabele za opremu */
CREATE TABLE equipment(
	equipment_id INT PRIMARY KEY AUTO_INCREMENT, 
    inventory VARCHAR(10) NOT NULL, 
    serialnumber VARCHAR(30),  
	datecreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    datemodified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    equiptype_id INT NOT NULL, 
    equipproducer_id INT NOT NULL,
    equipstatus_id INT,
    CONSTRAINT fk_equiptype_equipment FOREIGN KEY (equiptype_id) REFERENCES equiptype(equiptype_id) ON DELETE CASCADE, 
	CONSTRAINT fk_equipproducer_equipment FOREIGN KEY (equipproducer_id) REFERENCES equipproducer(equipproducer_id) ON DELETE CASCADE,
	CONSTRAINT fk_equipstatus_equipment FOREIGN KEY (equipstatus_id) REFERENCES equipstatus(equipstatus_id) ON DELETE CASCADE 
) ENGINE=INNODB;

/*Kreiranje trigera koji će prije unosa opreme, za unijetu opremu postaviti equipstatus_id na 1 - slobodna*/
CREATE TRIGGER insert_status BEFORE INSERT ON equipment
FOR EACH ROW SET new.equipstatus_id = 1;

/*Kreiranje tabele za organizacione jedinice*/
CREATE TABLE organization(
	organization_id INT PRIMARY KEY AUTO_INCREMENT,
    organization VARCHAR(200) NOT NULL
) ENGINE=INNODB;

/*Kreiranje tabele za kancelarije*/
CREATE TABLE office(
	office_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    office VARCHAR(30) NOT NULL
) ENGINE=INNODB;

/*Kreiranje tabele za zaposlene*/
CREATE TABLE employees(
	employees_id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(50),
	phone VARCHAR(30),
	datecreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    datemodified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    organization_id INT NOT NULL,
    office_id INT NOT NULL,
    CONSTRAINT fk_organization_employees FOREIGN KEY (organization_id) REFERENCES organization(organization_id) ON DELETE CASCADE,
    CONSTRAINT fk_office_employees FOREIGN KEY (office_id) REFERENCES office(office_id) ON DELETE CASCADE
) ENGINE=INNODB;

/*Kreiranje tabele za zaduženje opreme*/
CREATE TABLE equipemployee(
	equipemployee_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    employees_id INT NOT NULL,
    equipment_id INT NOT NULL,
    datecreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    datemodified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_employee_equipemployee FOREIGN KEY (employees_id) REFERENCES employees(employees_id) ON DELETE CASCADE,
    CONSTRAINT fk_equipment_equipemployee FOREIGN KEY (equipment_id) REFERENCES equipment(equipment_id) ON DELETE CASCADE
) ENGINE=INNODB;
    
/*Kreiranje tabele za potrebe prikaza broja zaposlenih po organizacionim jedinicama*/
CREATE TABLE employee_organization(
	organization VARCHAR(50), 
    employees_number INT
) ENGINE=INNODB;

/*Kreiranje tabele za potrebe prikaza broja opreme po tipu*/
CREATE TABLE equipment_type(
	equiptype VARCHAR(50), 
    equipment_number INT
) ENGINE=INNODB;

/*Kreiranje tabele za korisnike aplikacije*/
CREATE TABLE users(
	users_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    users_firstname VARCHAR(50) NOT NULL,
	users_lastname VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    users_role INT NOT NULL,
    pass VARCHAR(100) NOT NULL,
	datecreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    datemodified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

/*Unos podataka u tabelu tip opreme*/
INSERT INTO equiptype(equiptype) VALUES('Laptop');
INSERT INTO equiptype(equiptype) VALUES('Kućište');
INSERT INTO equiptype(equiptype) VALUES('Monitor');
INSERT INTO equiptype(equiptype) VALUES('Štampač');
INSERT INTO equiptype(equiptype) VALUES('Skener');
INSERT INTO equiptype(equiptype) VALUES('Server');
INSERT INTO equiptype(equiptype) VALUES('Fajervol');
INSERT INTO equiptype(equiptype) VALUES('Svič');

/*Unos podataka u tabelu proizvođač opreme*/
INSERT INTO equipproducer(equipproducer) VALUES('Hp');
INSERT INTO equipproducer(equipproducer) VALUES('Dell');
INSERT INTO equipproducer(equipproducer) VALUES('Acer');
INSERT INTO equipproducer(equipproducer) VALUES('Asus');
INSERT INTO equipproducer(equipproducer) VALUES('D-link');
INSERT INTO equipproducer(equipproducer) VALUES('Juniper');
INSERT INTO equipproducer(equipproducer) VALUES('Cisco');
INSERT INTO equipproducer(equipproducer) VALUES('Canon');

/*Unos podataka u tabelu status opreme*/
INSERT INTO equipstatus(equipstatus) VALUES('Slobodna');
INSERT INTO equipstatus(equipstatus) VALUES('Zadužena');

/*Unos podataka u tabelu organizacija*/
INSERT INTO organization(organization) VALUES('Odsjek 1');
INSERT INTO organization(organization) VALUES('Odsjek 2');
INSERT INTO organization(organization) VALUES('Odsjek 3');
INSERT INTO organization(organization) VALUES('Odsjek 4');
INSERT INTO organization(organization) VALUES('Odsjek 5');
INSERT INTO organization(organization) VALUES('Odsjek 6');
INSERT INTO organization(organization) VALUES('Odsjek 7');
INSERT INTO organization(organization) VALUES('Odsjek 8');

/*Unos podataka u tabelu kancelarija*/
INSERT INTO office(office) VALUES('1001');
INSERT INTO office(office) VALUES('1002');
INSERT INTO office(office) VALUES('1003');
INSERT INTO office(office) VALUES('1004');
INSERT INTO office(office) VALUES('1005');
INSERT INTO office(office) VALUES('1006');
INSERT INTO office(office) VALUES('1007');
INSERT INTO office(office) VALUES('1008');
INSERT INTO office(office) VALUES('1009');
INSERT INTO office(office) VALUES('1010');
INSERT INTO office(office) VALUES('1011');
INSERT INTO office(office) VALUES('1012');
INSERT INTO office(office) VALUES('1013');
INSERT INTO office(office) VALUES('1014');
INSERT INTO office(office) VALUES('1015');

/*Unos podataka u tabelu opreme*/
INSERT INTO equipment(inventory,serialnumber,equiptype_id,equipproducer_id) VALUES ('1000','A58HZT',1,1);
INSERT INTO equipment(inventory,serialnumber,equiptype_id,equipproducer_id) VALUES ('1001','HG5677',2,2);
INSERT INTO equipment(inventory,serialnumber,equiptype_id,equipproducer_id) VALUES ('1002','KJU879',3,3);
INSERT INTO equipment(inventory,serialnumber,equiptype_id,equipproducer_id) VALUES ('1003','DFR444',2,2);
INSERT INTO equipment(inventory,serialnumber,equiptype_id,equipproducer_id) VALUES ('1004','GFE345',1,3);
INSERT INTO equipment(inventory,serialnumber,equiptype_id,equipproducer_id) VALUES ('1005','876HZG',4,8);
INSERT INTO equipment(inventory,serialnumber,equiptype_id,equipproducer_id) VALUES ('1006','987JHG',6,1);
INSERT INTO equipment(inventory,serialnumber,equiptype_id,equipproducer_id)VALUES ('1007','543FFG',6,2);
INSERT INTO equipment(inventory,serialnumber,equiptype_id,equipproducer_id) VALUES ('1008','987NHG',1,4);
INSERT INTO equipment(inventory,serialnumber,equiptype_id,equipproducer_id) VALUES ('1009','763FGF',3,4);

/*Unos podataka u tabelu zaposlenih*/
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Mary','Smith','mary.smith@employee.org','+545451118222',1,1);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Patricia','Johnson','patricia.johnson@employee.org','+656757333222',1,2);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Linda','Williams','linda.williams@employee.org','+699857333222',2,3);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Marilyn','Simpson','marilyn.simpson@employee.org','+545732688222',3,4);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Patrik','Johnson','patrik.johnson@employee.org','+656875963222',4,15);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Luis','Davis','luis.davis@employee.org','+6955667333222',5,5);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Margaret','Moore','margaret.moore@employee.org','+4587267333222',6,6);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Dorothy','Taylor','dorothy.taylor@employee.org','+2548667333222',7,14);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Lisa','Anderson','lisa.anderson@employee.org','+55555667333222',8,9);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Nancy','Thomas','nancy.thomas@employee.org','+3785667333222',4,7);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Karen','Jackson','karen.jackson@employee.org','+6556667333222',4,10);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Betty','White','betty.white@employee.org','+6955967333222',8,8);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Helen','Harris','helen.harris@employee.org','+6955627833222',6,12);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Sandra','Martin','sandra.martin@employee.org','+69556679653222',7,11);
INSERT INTO employees(firstname,lastname,email,phone,organization_id,office_id) VALUES ('Donna','Thompson','donna.thompson@employee.org','+6955667248222',6,13);

/*Kreiranje pogleda za vraćanje liste opreme*/
CREATE VIEW equipment_list AS
	SELECT eq.equipment_id,et.equiptype,ep.equipproducer,eq.inventory,eq.serialnumber,eq.equipstatus_id,es.equipstatus,emp.firstname,emp.lastname,eqemp.datecreated 
    FROM equipment AS eq
    INNER JOIN equiptype AS et ON et.equiptype_id = eq.equiptype_id
    INNER JOIN equipproducer AS ep ON ep.equipproducer_id = eq.equipproducer_id
    INNER JOIN equipstatus AS es ON es.equipstatus_id = eq.equipstatus_id
    LEFT JOIN equipemployee AS eqemp ON eq.equipment_id = eqemp.equipment_id
    LEFT JOIN employees AS emp ON emp.employees_id = eqemp.employees_id;

/*Kreiranje pogleda za vraćanje liste zaposlenih sortiranih po organizacionim jedinicama*/
CREATE VIEW employees_list AS
	SELECT emp.employees_id,emp.firstname,emp.lastname,emp.email,emp.phone,off.office,org.organization
    FROM employees AS emp 
    INNER JOIN office AS off ON off.office_id = emp.office_id
    INNER JOIN organization AS org ON org.organization_id = emp.organization_id
    ORDER BY emp.organization_id;

/*Kreiranje pogleda za vraćanje liste zadužene opreme*/
CREATE VIEW equipemployee_list AS
	SELECT eqem.employees_id,eqem.equipment_id,emp.firstname,emp.lastname,et.equiptype,ep.equipproducer,eq.inventory,eq.serialnumber,off.office,off.office_id,org.organization_id,org.organization
    FROM equipemployee AS eqem
    INNER JOIN employees AS emp ON emp.employees_id = eqem.employees_id
    INNER JOIN equipment AS eq ON eq.equipment_id = eqem.equipment_id
    INNER JOIN equiptype AS et ON et.equiptype_id = eq.equiptype_id
    INNER JOIN equipproducer AS ep ON ep.equipproducer_id = eq.equipproducer_id
    INNER JOIN equipstatus AS es ON es.equipstatus_id = eq.equipstatus_id
	INNER JOIN office AS off ON off.office_id = emp.office_id
    INNER JOIN organization AS org ON org.organization_id = emp.organization_id
    ORDER BY eqem.equipemployee_id;

/*Kreiranje uskladištene procedure za zaduživanje zaposlenog opremom*/
DELIMITER $$
CREATE PROCEDURE equipemployee_obligation(
	IN emp int,
    IN equip int
)
BEGIN
	INSERT INTO equipemployee(employees_id,equipment_id) VALUES (emp,equip);
    UPDATE equipment SET equipstatus_id = 2 WHERE equipment.equipment_id = equip;
END$$

/*Kreiranje uskladištene procedure za razduživanje zaposlenog opremom*/
DELIMITER $$
CREATE PROCEDURE employeeequip_obligation(
	IN emp int,
    IN equip int
)
BEGIN
	DELETE FROM equipemployee WHERE employees_id = emp AND equipment_id = equip;
    UPDATE equipment SET equipstatus_id = 1 WHERE equipment.equipment_id = equip;
END$$

/*Kreiranje uskladištene procedure za vraćanje broja zaposlenih po organizacionim jedinicama*/
DELIMITER $$
CREATE PROCEDURE employee_organization()
BEGIN
DECLARE n INT DEFAULT 0;
DECLARE i INT DEFAULT 0;
SELECT COUNT(organization_id) FROM organization INTO n;
SET i = 1;
DELETE FROM employee_organization;
WHILE i <= n DO
	INSERT INTO employee_organization(organization, employees_number) SELECT o.organization,count(employees_id) FROM employees AS e
	INNER JOIN organization AS o ON o.organization_id = e.organization_id
	WHERE e.organization_id = i;
	SET i = i + 1;
END WHILE;
SELECT * FROM employee_organization;
END$$

/*Kreiranje uskladištene procedure za vraćanje opreme po tipu*/
DELIMITER $$
CREATE PROCEDURE equipment_type()
BEGIN
DECLARE n INT DEFAULT 0;
DECLARE i INT DEFAULT 0;
SELECT COUNT(equiptype_id) FROM equiptype INTO n;
SET i = 1;
DELETE FROM equipment_type;
WHILE i <= n DO
	INSERT INTO equipment_type(equiptype, equipment_number) SELECT et.equiptype,count(eq.equiptype_id) FROM equipment AS eq
    INNER JOIN equiptype AS et ON et.equiptype_id = eq.equiptype_id
	WHERE eq.equiptype_id = i;
	SET i = i + 1;
END WHILE;
SELECT * FROM equipment_type;
END$$



