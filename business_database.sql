/*Negocio*/
create table business(
	id_business int auto_increment,
    commercial_name varchar(50) not null,
	fiscal_name varchar(60) null,
	type_business varchar(50) null,
    constraint id_business_pk primary key(id_business),
    constraint commercial_name_un unique(commercial_name)
);

create table aboutBusiness(
	id_aboutBusiness int auto_increment,
    id_business int not null,
    profile_photo text,    
    phone_business varchar(30),
    invoice boolean null,
    business_antiquity date,
    customer_antiquity date,
    dateRegistration date,
    email varchar(60),
    timeBusinessI time,
    timeBusinessF time,
    perfil_facebook varchar(50),
    url_facebook text null,
    url_googlemaps text,
    phones_business text,
    days_available text,
    how_know_us text,
    frequency varchar(50) null,
    comments text,
    constraint id_aboutBusiness_pk primary key(id_aboutBusiness),
    constraint id_business_about_fk foreign key(id_business) references business(id_business)
);


create table business_address(
	id_business_address int auto_increment,
    id_business int not null,
    state varchar(50), 
    city varchar(50),
    street varchar(50),
    colony varchar(50),
    local varchar(50),
    constraint id_business_address_pk primary key(id_business_address),
    constraint id_business_address_fk foreign key(id_business) references business(id_business)
);

create table alternatives_address_business(
	id_alt_address int auto_increment,
	id_business int not null,
    name_business varchar(50),
    phone_business varchar(50),
	state varchar(50) null, 
	city varchar(50) null,
	street varchar(50) null,
    colony varchar(50),
    local varchar(50),
    constraint id_alt_address_pk primary key(id_alt_address),
    constraint id_business_fk_alt foreign key(id_business) references business(id_business)
);

create table friends_family_business(
	id_friends_family int auto_increment,
    name_fri_fam varchar(50),
    first_surname varchar(50),
    second_surname varchar(50),
    relation varchar(40),
    id_business int, /*Error aqui*/
    constraint id_friends_family_pk primary key(id_friends_family),
    constraint id_business_friends foreign key(id_business) references business(id_business)
);

create table referenced_business(
	id_referenced int auto_increment,
	id_business int not null,
	name_business varchar(50),
    phone_business varchar(50),
	state varchar(50) null, 
	city varchar(50) null,
	street varchar(50) null,
    constraint id_referenced_pk primary key(id_referenced),
    constraint id_business_fk_ref foreign key(id_business) references business(id_business)
);


drop table business;
drop table aboutBusiness;
drop table business_address;
drop table alternatives_address_business;
drop table friends_family_business;
drop table referenced_business;

select  business.id_business, commercial_name, fiscal_name, type_business, 
		profile_photo, phone_business, invoice, business_antiquity, customer_antiquity, email, timeBusinessI, 
        timeBusinessF, perfil_facebook, url_facebook, url_googlemaps, phones_business, days_available, 
        how_know_us, frequency, comments, dateRegistration, state, city, street, colony, local
        from business
        INNER JOIN aboutBusiness about on about.id_business = business.id_business
        INNER JOIN business_address address on address.id_business = business.id_business;

insert into aboutBusiness (dateRegistration) values ('1998-03-04');

select * from business_address;

select  business.id_business, commercial_name, fiscal_name, 
		profile_photo, email, 
        phones_business, dateRegistration
        from business
        INNER JOIN aboutBusiness about on about.id_business = business.id_business limit 0, 9;
        
        
insert into alternatives_address_business(id_business, name_business, phone_business, state, city, street, colony, local) values (1, 'Otro negocio', '74839243', 'NUEVO LEON', 'MONTERREY', '15 DE MAYO', 'VALLE DE SOLIDARIDAD');


insert into friends_family_business(id_business, name_fri_fam, first_surname, second_surname, relation) values (1,'');



delete from aboutBusiness where id_business = 2;
delete from business_address where id_business = 2;
delete from friends_family_business where id_business = 2;
delete from referenced_business where id_business = 2;
delete from business where id_business = 2;


select  business.id_business, commercial_name, fiscal_name, 
		profile_photo, email, 
        phones_business, dateRegistration
        from business
        INNER JOIN aboutBusiness about on about.id_business = business.id_business
        INNER JOIN contact_business cont_bus on cont_bus.id_business = business.id_business where commercial_name like '%alcon%' or fiscal_name like '%alcon%' or email like '%alcon%' limit 0, 1;
        
update alternatives_address_business set name_business = 'Alcon', phone_business = '81843754' , state = 'NUEVO LEON', 
city = 'MONTERREY', street = '15 DE MAYO', colony = 'VALLES', local = 'KAUJSBD' where id_business = 1 and id_alt_address = 2;

select  business.id_business, commercial_name, fiscal_name, 
            profile_photo, email, 
            phone_business
            from business
            INNER JOIN aboutBusiness about on about.id_business = business.id_business where commercial_name like '%alcon%' limit 1, 0;
            
            
            select count(id_business) total from business;