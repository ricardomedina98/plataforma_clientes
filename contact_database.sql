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
    subject varchar(50) not null,
    description text null,
    constraint id_incident_pk primary key(id_incident),
    constraint id_contact_fk_inc foreign key(id_contact) references contacts(id_contact)
);

update incidents set subject = 'Algo', description = 'Algo' where id_incident = 1 and id_contact = 1;
delete from incidents where id_incident = 1;


select * from contacts;
select * from about_contact;
select * from contact_address;
select * from tickets;



/*Show all contacts*/
SELECT contact.id_contact, profile_photo, alias, email, mobile_phone
FROM contacts contact
INNER JOIN about_contact ab_cont ON contact.id_contact=ab_cont.id_contact;
	
    
/*Show one contact*/
SELECT 	contact.id_contact, name_contact, first_surname, second_surname,
		state, city, street, colony, local,
        profile_photo, alias, email, birthday, date_registration, mobile_phone, frequency, perfil_facebook, url_facebook, comments, ab_cont.seller
FROM contacts contact
INNER JOIN about_contact ab_cont ON contact.id_contact = ab_cont.id_contact
INNER JOIN contact_address address_cont ON contact.id_contact = address_cont.id_contact
WHERE contact.id_contact=1;


insert into contact_address(id_contact, state, city, colony, street, local) values (1, '', '', '', '', '');


update contacts set name_contact = 'Jose Ricardo', first_surname = 'Medina', second_surname = 'Lopez' where id_contact = 1;

update contact_address set state = 'Nuevo Leon', city = 'Monterrey', street = '15 de Mayo', colony = 'Valles de Solidaridad', local = 'Local 11' where id_contact = 1;

update about_contact set alias = 'Richard', email = 'riky_030498@live.com', birthday = '1998-03-04', date_registration = '2018-03-04', mobile_phone = '81-15-37-53-67', frequency = 'Nuevo', perfil_facebook = 'Jose Ricardo Medina', url_facebook = 'https://www.facebook.com/', seller = 'Fabiola', comments = 'Comentarios' where id_contact = 1;

select id_ticket, photo_ticket, folio, branch, seller, totalAmount from tickets where id_contact = 1;

SELECT profile_photo FROM contacts contact INNER JOIN about_contact ab_cont ON contact.id_contact=ab_cont.id_contact;



SELECT contact.id_contact, name_contact, first_surname, second_surname,
		state, city, street, colony, local,
        profile_photo, alias, email, birthday, date_registration, mobile_phone, frequency, perfil_facebook, url_facebook, comments, ab_cont.seller 
        FROM contacts contact
        INNER JOIN about_contact ab_cont ON contact.id_contact = ab_cont.id_contact
        INNER JOIN contact_address address_cont ON contact.id_contact = address_cont.id_contact
        where name_contact like '%jose%' or first_surname like '%jose%' or second_surname like '%jose%' or email like '%jose%' or alias like '%jose%';
        
        
        
        
        SELECT contact.id_contact, profile_photo, name_contact, first_surname, second_surname, email, mobile_phone, state
        FROM contacts contact 
        INNER JOIN about_contact ab_cont ON contact.id_contact=ab_cont.id_contact 
        INNER JOIN contact_address address_cont ON contact.id_contact = address_cont.id_contact
        ;
        
        select commercial_name from business where id_business = (select id_business from contacts cont
		INNER JOIN contact_business cont_bus ON cont_bus.id_contact = cont.id_contact where cont.id_contact = 4);
        
        
        SELECT contact.id_contact, profile_photo, name_contact, first_surname, second_surname, email, mobile_phone 
        FROM contacts contact 
        INNER JOIN about_contact ab_cont ON contact.id_contact=ab_cont.id_contact 
        INNER JOIN contact_address address_cont ON contact.id_contact = address_cont.id_contact = 7;
        
        
insert into contact_business(id_contact, id_business) values (37, (select id_business from business where commercial_name = 'Elmaples1'));

insert into contact_business(id_contact) values (37);
select * from contact_business;

delete from contact_business where id_contact = 2;


update contact_business set id_business = (select id_business from business where commercial_name = 'Alcon Supermarket') where id_contact = 6;
update contact_business set id_business = (select id_business from business where commercial_name = 'Alcon Supermarket') where id_contact = 36;

