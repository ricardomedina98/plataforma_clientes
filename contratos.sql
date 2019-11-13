create table employees(
	id_employee int auto_increment,
    name_employee varchar(50) not null,
    first_surname varchar(50) not null,
    second_surname varchar(50) not null,
    sex varchar(1) not null,
    category varchar(100) null,
    position varchar(100) not null,
    date_birthday_empl date not null,
    civil_status varchar(30) not null,
    nss_employee varchar(30) not null,
    num_employee int null,
    status varchar(1) not null DEFAULT 'A',
    constraint id_employee_empl_pk primary key(id_employee),
    constraint sex_employee_check check(sex in ('H', 'M')),
    constraint status_employee_check check(status in ('A', 'I'))
);

CREATE TABLE employee_address (
    id_employee_address INT AUTO_INCREMENT,
    id_employee INT NOT NULL,
    state VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    street VARCHAR(50) NOT NULL,
    colony VARCHAR(50) NOT NULL,
    postal_code VARCHAR(50) NOT NULL,
    CONSTRAINT id_employee_address_empl_addre_pk PRIMARY KEY (id_employee_address),
    CONSTRAINT id_employee_address_fk FOREIGN KEY (id_employee) REFERENCES employees (id_employee)
);

create table contract_undefined(
	id_contract_undefined int auto_increment,
	id_employee int not null,
    id_employee_address int not null,
    weekly_balance float(8,2) not null,  
    weekly_import float(8,2) not null,  
    begin_contract date not null,
    contract_created datetime null,
    constraint pk_id_contract_undefined primary key(id_contract_undefined),
    constraint fk_id_employee_cont_undefined foreign key(id_employee) references employees(id_employee),
    constraint fk_id_employee_address_cont_undefined foreign key(id_employee_address) references employee_address(id_employee_address)
);

create table contract_temp(
	id_contract_temp int auto_increment,
    id_employee int not null,
    begin_contract date not null,
	end_contract datetime not null,
    daily_balance float(8,2) not null,
    contract_created datetime null,
    constraint pk_id_contract_temp primary key(id_contract_temp),
    constraint fk_id_employee_contract_temp foreign key(id_employee) references employees(id_employee)
);


insert into employees(num_employee, name_employee, first_surname, second_surname, sex, 
					category, position, date_birthday_empl, civil_status, nss_employee)
VALUES (1330, 'José Ricardo', 'Medina', 'López', 'H', 'SISTEMAS', 'DESARROLADOR', '1998-04-03', 'SOLTERO', '4573898434');

select * from employees;