/*Contacto*/
create table contacts(
	id_contact int auto_increment,
    name_contact varchar(50),
    first_surname varchar(50),
    second_surname varchar(50),
    constraint id_contact_pk primary key(id_contact)
);

create table contact_address(
	id_contact_address int auto_increment,
    id_contact int not null,
    state varchar(50), 
    city varchar(50),
    street varchar(50),
    colony varchar(50),
    local varchar(50),
    constraint id_contact_address_pk primary key(id_contact_address),
    constraint id_contact_fk_addre foreign key(id_contact) references contacts(id_contact)
);

create table about_contact(
	id_about_contact int auto_increment,
    id_contact int not null,
    profile_photo text not null,
    alias varchar(50) null,
    email text null,
    birthday date null,
    date_registration date null,
    mobile_phone varchar(20) null,
    frequency varchar(50) null,
    perfil_facebook varchar(50) null,
    url_facebook text null,
    comments text null,
    seller varchar(50) null,
    type_business varchar(30),
    name_business varchar(30),
    constraint id_about_contact_pk primary key(id_about_contact),
    constraint id_contact_fk_about foreign key(id_contact) references contacts(id_contact)
);

create table tickets(
	id_ticket int auto_increment,
    photo_ticket text not null,
    folio int not null,
    branch varchar(50) null,
    seller varchar(20) null,
    totalAmount float(8,2) null,
    
    date_ticket timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    id_contact int not null,
    constraint id_ticket primary key(id_ticket),
    constraint id_contact_fk_contacts foreign key(id_contact) references contacts(id_contact)
);

create table incidents(
	id_incident int auto_increment,
    id_contact int,
    subject text not null,
    description text null,
    dateIncident date null,
    timeIncident time null,
    place varchar(50) null,
    personal_involved text null,
    constraint id_incident_pk primary key(id_incident),
    constraint id_contact_fk_inc foreign key(id_contact) references contacts(id_contact)
);


create table contact_products(
	id_contact_product int auto_increment,
    id_contact int not null,
    name_product varchar(255) not null,
    brand varchar(255) not null,
    quantity varchar(255) null,
    cut varchar(255) not null,
    constraint pk_id_contact_product primary key(id_contact_product),
    constraint fk_id_contact_products foreign key(id_contact) references contacts(id_contact)
);

create table own_business(
	id_own_business int auto_increment,
    name_business varchar(150) not null,
    constraint pk_id_own_business primary key(id_own_business)
);

create table own_business_contact(
	id_contact int not null,
    id_own_business int not null,
    constraint fk_id_contact_own_busi_cont foreign key(id_contact) references contacts(id_contact),
    constraint fk_id_own_business_own_busi_cont foreign key(id_own_business) references own_business(id_own_business)
);

insert into own_business(name_business) values ('Alcon Supermarket');
insert into own_business(name_business) values ('Mayoreo de Carnes Estrella');

select

create table types_relationships(
	id_type_relationship int auto_increment,
    type_relationship varchar(255) not null,
    constraint pk_id_type_relationship primary key(id_type_relationship)
);

select tr.id_type_relationship, tr.type_relationship from types_relationships tr;

insert into types_relationships(type_relationship) values ('Padre');
insert into types_relationships(type_relationship) values ('Madre');	
insert into types_relationships(type_relationship) values ('Abuelo/a');
insert into types_relationships(type_relationship) values ('Hijo/a');
insert into types_relationships(type_relationship) values ('Tio/a');
insert into types_relationships(type_relationship) values ('Primo/a');


create table relationships(
	id_relationship int auto_increment,
    id_relation_origin int not null,
    origin varchar(100) not null,
    id_relation_destination int not null,
    destination varchar(100) not null,
	id_type_relationship int not null,
	constraint pk_id_relationship primary key(id_relationship),
    constraint fk_id_type_relationship_relationships 
		foreign key(id_type_relationship) references types_relationships(id_type_relationship)
);

insert into relationships(id_relation_origin, origin, id_relation_destination, destination, id_type_relationship)
	values (22, 'contact', 2, 'contact', 1);

update relationships set id_relation_destination = 3, destination = 'owner', id_type_relationship = 3 where id_relationship = 29;

delete from relationships where id_relationship = 18;

select * from relationships;

update relationships set id_relation_destination = 4, destination = 'contact', id_type_relationship = 22 where id_relationship = 31;

select * from owners where id_owner = 3;

select 
	r.origin, 
    r.id_relationship, 
    id_relation_origin, 
    c.name_contact as name_origin, 
    tr.id_type_relationship,
    tr.type_relationship, 
    id_relation_destination,
    IFNULL(cd.name_contact, ow.name_owner) as name_destination,
    r.destination
    from relationships r
	inner join contacts c on c.id_contact = r.id_relation_origin and r.origin = 'contact'
    left join contacts cd on cd.id_contact = r.id_relation_destination and r.destination = 'contact'
    left join owners ow on ow.id_owner = r.id_relation_destination and r.destination = 'owner'
    left join types_relationships tr on tr.id_type_relationship = r.id_type_relationship 
where c.id_contact = 4 and r.destination = 'contact' or r.destination = 'owner';
    
select 
	r.origin, 
    r.id_relationship, 
    id_relation_origin, 
    IFNULL(c.name_contact, o.name_owner) as name_origin, 
    IFNULL(c.first_surname, o.first_surname) as first_surname_origin,
    IFNULL(c.second_surname, o.second_surname) as second_surname_origin,
    tr.id_type_relationship,
    tr.type_relationship, 
    id_relation_destination,
    IFNULL(cd.name_contact, ow.name_owner) as name_destination,
	IFNULL(cd.first_surname, ow.first_surname) as first_surname_destination,
    IFNULL(cd.second_surname, ow.second_surname) as second_surname_destination,
    r.destination
    from relationships r
	left join contacts c on c.id_contact = r.id_relation_origin and r.origin = 'contact'
    left join owners o on o.id_owner = r.id_relation_origin and r.origin = 'owner'
    left join contacts cd on cd.id_contact = r.id_relation_destination and r.destination = 'contact'
    left join owners ow on ow.id_owner = r.id_relation_destination and r.destination = 'owner'
    inner join types_relationships tr on tr.id_type_relationship = r.id_type_relationship 
where c.id_contact = 4 and r.destination = 'contact' or r.destination = 'owner';


SELECT contact.id_contact, profile_photo, name_contact, first_surname, 
		second_surname, email, mobile_phone, alias
FROM contacts contact 
INNER JOIN about_contact ab_cont 
ON contact.id_contact = ab_cont.id_contact and contact.id_contact != 3;



