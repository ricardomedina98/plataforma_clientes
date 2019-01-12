drop database plataforma_clientes;
create database plataforma_clientes;
use plataforma_clientes;

create table users(
id_user int auto_increment,
name_user varchar(30) not null,
user_name varchar(30) not null,
password_user text not null,
type_user text not null,
status boolean DEFAULT 1,
last_logged datetime null,
constraint id_user_users primary key(id_user),
constraint user_name_unique unique(user_name)
);

select id_user from users where type_user 'Administrador';
update users set status = 1 where id_user = 1;


insert into business(commercial_name, fiscal_name, type_business, type_customer) values ('Alcon Supermarket', 'Mercado de Carnes Estrella S.A de C.V', 'Venta de Alimentos', '');

insert into aboutBusiness(id_aboutBusiness, id_business, profile_photo, invoce, business_antiquity, 
							customer_antiquity, timeBusinessI, timeBusinessF, perfil_facebook, url_facebook, 
                            email, url_googlemaps, comments, phones_business, days_available, how_know_us, frequency) 
values (1, 1, 'views/img/users/contactos/6/profile446.jpg', true, '11 años', '1 año', '18:30:00', '22:30:00', 'Alcon Supermarket', 'https://www.facebook.com/rikamedinalopez' ,'riky_030498@live.com' ,'url de google maps', 'cometarios', 'phones_business', 'days_available', 'how_know_us', 'frequency'); 

select id_user, name_user, user_name, type_user, status, last_logged, password_user from users;

/*Dueños*/

drop table users;


SELECT LAST_INSERT_ID();

/*Relaciones*/
create table contact_business(
	id_contact int not null,
    id_business int,
    constraint id_contact_fk_cont_bu foreign key(id_contact) references contacts(id_contact),
    constraint id_business_fk_cont_bu foreign key(id_business) references business(id_business),
    constraint id_contact_unq_cont_bu unique(id_contact)
);

create table owner_business(
	id_owner int not null,
    id_business int,
    constraint id_business_fk_own_bu foreign key(id_business) references business(id_business),
    constraint id_owner_fk_own_bu foreign key(id_owner) references owners(id_owner)
);

delete from aboutBusiness where id_business = 1;
delete from business_address where id_business = 1;
delete from friends_family_business where id_business = 1;
delete from referenced_business where id_business = 1;
delete from contact_business where id_business = 1;
delete from owner_business where id_business = 1;
delete from business where id_business = 1;

SELECT * FROM users;

/*Modificaciones*/

create table own_businesses(
id_own_business int auto_increment,
cause text not null,
description_incident text,
id_contact int not null,
constraint id_own_business_pk_own primary key(id_own_business),
constraint id_contact_fk_own_b foreign key(id_contact) references contacts(id_contact)
);
select user_name from users where user_name = 'ricardo_medina03';

