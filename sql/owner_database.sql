create table owners(
	id_owner int auto_increment,
	name_owner varchar(50),
    first_surname varchar(50),
    second_surname varchar(50),
    constraint id_owner_pk primary key(id_owner)
);

create table aboutOwners(
	id_aboutOwner int auto_increment,
    id_owner int not null,
	profile_photo text null,	
    alias varchar(50) null,
    birthday date null,
    date_registration date null,
    mobile_phone varchar(20) null,
    perfil_facebook text null,
    url_facebook text null,
    frequency varchar(50) null,
	email text null,
    comments text null,
	type_business varchar(30) null,
    name_business varchar(30) null,
	constraint id_aboutOwner_pk_ab primary key(id_aboutOwner),
    constraint id_owner_fk_ab foreign key(id_owner) references owners(id_owner)
);

create table address_owner(
	id_own_address int auto_increment,
	id_owner int not null,
	state varchar(50) null, 
	city varchar(50) null,
	street varchar(50) null,
    colony varchar(50) null,
    local varchar(50) null,
    constraint id_own_address_pk primary key(id_own_address),
    constraint id_owenr_fk_alt foreign key(id_owner) references owners(id_owner)
);

create table buying_habits(
	id_buying_habits int auto_increment,
    id_owner int not null,
    products text null,
    days_buy text null,    
    constraint id_buying_habits_pk primary key(id_buying_habits),
    constraint id_owner_fk_own_hab foreign key(id_owner) references owners(id_owner)
);

create table departaments(
	id_departament int auto_increment,
    id_owner int not null,
    name_departament text null,
    orderby text null,
    constraint id_departament_pk primary key(id_departament),
    constraint id_owner_fk_dep foreign key(id_owner) references owners(id_owner)
);





drop table departaments;
drop table address_owner;
drop table buying_habits;
drop table aboutOwners;
drop table owners;




insert into owners(id_owner, name_owner, first_surname, second_surname) values (1, 'Jose Ricardo', 'Medina', 'Lopez');

update owners set name_owner = 'Nombre', first_surname = 'Apellido1', second_surname = 'Apellido2' where id_owner = 1;

insert into aboutOwners(id_owner, profile_photo, alias, birthday, date_registration, mobile_phone, 
					perfil_facebook, url_facebook, frequency, email, comments, type_business, name_business) 
values (1, 'views/img/users/default/anonymous.jpg', 'Richard', '1998-03-04', '2018-03-04', '8115375367', 'Jose Ricardo Medina', 'https://www.facebook.com/', '1 vez a la semana', 
						'riky_030498@live.com', 'Comentarios', 'Carnes', 'Alcon');

update aboutOwners set profile_photo = 'views/img/users/default/anonymous.jpg', alias = 'Richard', birthday = '1998-03-04', date_registration = '2018-03-04',
					mobile_phone = '8115375367', perfil_facebook = 'Jose Ricardo Medina', url_facebook = 'https://www.facebook.com/', frequency = '1 vez a la semana',
                    email = 'riky_030498@live.com', comments = 'Comentarios', type_business = 'type_business', name_business = 'Alcon' where id_owner = 1;

insert into address_owner(id_owner, state, city, street, colony, local) values (1, 'NUEVO LEON', 'MONTERREY', '15 de Mayo', 'Valles de Solidaridad', 'Local 1');

insert into buying_habits(id_owner, products, days_buy) values (1, 'Productos', 'Lunes,Martes');

update buying_habits set products = '', days_buy = '' where id_owner = 1;

insert into departaments(id_owner, name_departament, orderby) values (1, 'Carnes', 'Whatsapp,Telefono');
update departaments set name_departament = '', orderby = '' where id_owner = 1;

select own.id_owner, name_owner, first_surname, second_surname, profile_photo, alias, birthday, date_registration, mobile_phone, perfil_facebook, url_facebook, frequency, email, comments
state, city, street, colony, local, products, days_buy,
name_departament, orderby
from owners own 
inner join aboutOwners ab on own.id_owner = ab.id_owner
inner join address_owner ad on own.id_owner = ad.id_owner
inner join buying_habits hb on own.id_owner = hb.id_owner
inner join departaments dep on own.id_owner = dep.id_owner where own.id_owner = 3;


select name_owner, first_surname, second_surname, profile_photo, mobile_phone, email
from owners own 
inner join aboutOwners ab on own.id_owner = ab.id_owner limit 0, 1;


select ab.id_owner, name_owner, first_surname, second_surname, profile_photo, alias, birthday, date_registration, mobile_phone, perfil_facebook, url_facebook, frequency, email, comments, state, city, street, colony, local, products, days_buy, name_departament, orderby
        from owners own 
        inner join aboutOwners ab on own.id_owner = ab.id_owner
        inner join address_owner ad on own.id_owner = ad.id_owner
        inner join buying_habits hb on own.id_owner = hb.id_owner
        inner join departaments dep on own.id_owner = dep.id_owner where own.id_owner = 1;
        
        
select ab.id_owner, name_owner, first_surname, second_surname, profile_photo, alias, birthday, date_registration, mobile_phone, perfil_facebook, url_facebook, frequency, email, comments, state, city, street, colony, local, products, days_buy, name_departament, orderby, type_business, name_business
        from owners own 
        inner join aboutOwners ab on own.id_owner = ab.id_owner
        inner join address_owner ad on own.id_owner = ad.id_owner
        inner join buying_habits hb on own.id_owner = hb.id_owner
        inner join departaments dep on own.id_owner = dep.id_owner where own.id_owner = 4;
        
        
        
delete from departaments where id_owner = 1;
delete from address_owner where id_owner = 1;
delete from buying_habits where id_owner = 1;
delete from aboutOwners where id_owner = 1;
delete from owner_business where id_owner = 1;
delete from owners where id_owner = 1;