create table products(
    id_product int auto_increment primary key,
    name varchar(255) not null,
    short_name varchar(255) not null,
    part_number varchar(255) not null,
    invoice text not null,
    description text not null,
    id_unit int not null,
    id_brand int not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp null,
    constraint id_unit_products_unit foreign key(id_unit) references units(id_unit),
    constraint id_brand_products foreign key(id_brand) references brands_products(id_brand)
);

create table products_work_orders(
	id_product int not null,
    id_work_order int not null,
    constraint id_product_work_orders foreign key(id_product) references products(id_product),
    constraint id_word_order_work_orders foreign key(id_work_order) references work_orders(id_work_order)
);

create table brands_products(
	id_brand int auto_increment primary key,
    name varchar(255) not null,
    description text null
);

create table units(
	id_unit int auto_increment primary key,
    type_unit varchar(255) not null
);

create table work_orders(
	id_work_order int auto_increment primary key
);

insert into units(id_unit, type_unit) values (1, 'PIEZA');
insert into brands_products(id_brand, name, description) values (1, 'MARCA 01', 'Descipción de la marca.');

insert into products(name, short_name, part_number, invoice, description, id_unit, id_brand)
	values ('MAQUINA', 'MAQUINARIA-01', '3287482338', 'ruta-factura', 'Maquina numero uno', 1, 1);
select * from
