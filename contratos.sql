use plataforma_clientes;

drop table employees_contract_info;
drop table addressBirthday_employee;
drop table employee_address;
drop table employees;

SELECT * FROM employees;

create table employees(
	id_employee int auto_increment,
    name_employee varchar(50) not null,
    first_surname varchar(50) not null,
    second_surname varchar(50) not null,
    sex_employee varchar(1) not null,
    position_employee varchar(40) not null,
    date_birthday_empl date not null,
    civil_status varchar(30) not null,
    nss_employee varchar(30) not null,
    num_employee int null,
    status_employee varchar(1) not null DEFAULT 'A',
    constraint id_employee_empl_pk primary key(id_employee),
    constraint sex_employee_check check(sex_employee in ('H', 'M')),
    constraint status_employee_check check(status_employee in ('A', 'I')),
    constraint nss_employee_un_empl unique(nss_employee),
    constraint num_employee_un_empl unique(num_employee)
);



create table addressBirthday_employee(
	id_addressBirthday_employee int auto_increment,
    placeCityBirthday varchar(50) not null,
    placeStateBirthday varchar(50) not null,
    id_employee int not null,
    constraint id_addressBirthday_employee_pk primary key(id_addressBirthday_employee),
    constraint id_employee_add_birthDay_fk foreign key(id_employee) references employees(id_employee)
);

create table employee_address(
	id_employee_address int auto_increment,
    id_employee int not null,
    state varchar(50) not null, 
    city varchar(50) not null,
    street varchar(50) not null,
    colony varchar(50) not null,
    postal_code varchar(50) not null,
    constraint id_employee_address_empl_addre_pk primary key(id_employee_address),
    constraint id_employee_address_fk foreign key(id_employee) references employees(id_employee)
);

create table employees_contract_info(
	  id_contract int auto_increment,
    id_employee int not null,
    start_contract datetime not null,
    end_contract datetime not null,
    contract_created datetime null,
    weekly_balance float(8,2) not null,    
    punctuality_award float(8,2) not null,
    attendance_prize float(8,2) not null,
    constraint id_contract_info_pk primary key(id_contract), 
    constraint id_employee_info_fk foreign key(id_employee) references employees(id_employee)
);




CALL create_employee('JOSE RICARDO', 'MEDINA', 'LOPEZ', 'H', 'TABLAJERO', '2018-04-03', 'CASADO', '912831920', 'SAN NICOLAS DE LOS GARZA', 'NUEVO LEON', 
					'NUEVO LEON', 'MONTERREY', '15 DE MAYO', 'VALLES DE SOLIDARIDAD', '66700',
                    '2019-05-01 13:30:00', '2019-05-02 13:30:00', now(), 812.02, 81.10, 81.10
                    );


SELECT dayname(date_birthday_empl), monthname(date_birthday_empl), year(date_birthday_empl) FROM employees;

SELECT nss_employee FROM employees where nss_employee = '912831923';



SELECT empl.id_employee, name_employee, first_surname, second_surname, sex_employee, position_employee, 
		date_birthday_empl, civil_status,nss_employee, num_employee, status_employee ,
        
        placeCityBirthday, placeStateBirthday
        
        state, city, street, colony, postal_code
        
        start_contract, end_contract, contract_created, weekly_balance, punctuality_award, attendance_prize
        
FROM employees empl inner join addressBirthday_employee Baddress on empl.id_employee = Baddress.id_employee
					inner join employee_address emplAddress on emplAddress.id_employee = empl.id_employee
                    inner join employees_contract_info infoContract on infoContract.id_employee = empl.id_employee;


USE plataforma_clientes;

SELECT * FROM addressbirthday_employee ae;

SELECT empl.id_employee, name_employee, first_surname, second_surname, sex_employee, position_employee, 
	    	date_birthday_empl, civil_status,nss_employee, num_employee, status_employee ,
        
        placeCityBirthday, Baddress.placeStateBirthday,
        
        state, city, street, colony, postal_code,
        
        start_contract, end_contract, contract_created, weekly_balance, punctuality_award, attendance_prize
        
        FROM employees empl inner join addressBirthday_employee Baddress on empl.id_employee = Baddress.id_employee
            inner join employee_address emplAddress on empl.id_employee = emplAddress.id_employee 
            inner join employees_contract_info infoContract on empl.id_employee = infoContract.id_employee

            WHERE status_employee = 'A' AND empl.id_employee = :id_employee;

SELECT * FROM employees_contract_info eci;


CALL update_employee(1, 'Jose Ricardo', 'Medina', 'Lopez', 'H', 'SISTE', '1998/04/03', 'SOLTERO', '187236', 1330, 'SAN NICOLAS DE LOS GARZA', 
  'NUEVO LEON', 'NUEVO LEON', 'MARIN', '15 DE MAYO', 'VALLES DE SOLIDARIDAD', '66700', '2019/02/23 09:00:00', 
  '2019/02/24 09:00:00', '2019/02/23 12:00:00', 811.10, 100.00, 200.00, @result);

SELECT @result;



UPDATE employees e set sta




		
        
