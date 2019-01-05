drop database plataforma_clientes;
create database plataforma_clientes;
use plataforma_clientes;

create table users(
id_user int auto_increment,
name_user varchar(30) not null,
user_name text,
password_user varchar(30) not null,
foto text null,
last_logged datetime null,
last_modify timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
constraint id_user_users primary key(id_user)
);

insert into users(name_user, user_name, password_user) values ('Jose Ricardo', 'ricardo_medina03', 'ricardo');
insert into users(name_user, user_name, password_user) values ('Norma', 'monitoreosn', 'monitoreosn01');
insert into users(name_user, user_name, password_user) values ('Oscar', 'oscar1', 'oscar');

select user_name, password_user from users where user_name = 'monitoreosn@grupoalcon.com.mx' and password_user = 'monitoreosn01';

insert into business(commercial_name, fiscal_name, type_business, type_customer) values ('Alcon Supermarket', 'Mercado de Carnes Estrella S.A de C.V', 'Venta de Alimentos', '');

insert into aboutBusiness(id_aboutBusiness, id_business, profile_photo, invoce, business_antiquity, 
							customer_antiquity, timeBusinessI, timeBusinessF, perfil_facebook, url_facebook, 
                            email, url_googlemaps, comments, phones_business, days_available, how_know_us, frequency) 
values (1, 1, 'views/img/users/contactos/6/profile446.jpg', true, '11 años', '1 año', '18:30:00', '22:30:00', 'Alcon Supermarket', 'https://www.facebook.com/rikamedinalopez' ,'riky_030498@live.com' ,'url de google maps', 'cometarios', 'phones_business', 'days_available', 'how_know_us', 'frequency'); 

select * from aboutBusiness;




/*Dueños*/


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

SELECT * FROM users


