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
    quantity_total varchar(255) null,
    quantity_unitary varchar(255) null,
    constraint pk_id_contact_product primary key(id_contact_product),
    constraint fk_id_contact_products foreign key(id_contact) references contacts(id_contact)
);
