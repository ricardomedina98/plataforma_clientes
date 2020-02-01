

CREATE TABLE plataforma_clientes.employees (
    id_employee INT AUTO_INCREMENT PRIMARY KEY,
    name_employee VARCHAR(50) NOT NULL,
    first_surname VARCHAR(50) NOT NULL,
    second_surname VARCHAR(50) NOT NULL,
    sex VARCHAR(1) NOT NULL,
    category VARCHAR(100) NULL,
    position VARCHAR(100) NOT NULL,    
    civil_status VARCHAR(30) NOT NULL,
    nss_employee VARCHAR(30) NOT NULL,
    num_employee INT NULL,
    status VARCHAR(1) DEFAULT 'A' NOT NULL
);

CREATE TABLE plataforma_clientes.employee_address (
    id_employee_address INT AUTO_INCREMENT PRIMARY KEY,
    id_employee INT NOT NULL,
    state VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    colony VARCHAR(255) NOT NULL,
    postal_code VARCHAR(50) NOT NULL,
    CONSTRAINT id_employee_address_fk FOREIGN KEY (id_employee)
        REFERENCES plataforma_clientes.employees (id_employee)
);


CREATE TABLE plataforma_clientes.contract_temp (
    id_contract_temp INT AUTO_INCREMENT PRIMARY KEY,
    id_employee INT NOT NULL,
    begin_contract DATE NOT NULL,
    end_contract DATETIME NOT NULL,
    daily_balance FLOAT NOT NULL,
    contract_created DATETIME NULL,
    CONSTRAINT fk_id_employee_contract_temp FOREIGN KEY (id_employee)
        REFERENCES plataforma_clientes.employees (id_employee)
);

CREATE TABLE plataforma_clientes.contract_undefined (
    id_contract_undefined INT AUTO_INCREMENT PRIMARY KEY,
    id_employee INT NOT NULL,
    id_employee_address INT NOT NULL,
    weekly_balance FLOAT NOT NULL,
    weekly_import FLOAT NOT NULL,
    begin_contract DATE NOT NULL,
    contract_created DATETIME NULL,
    CONSTRAINT fk_id_employee_address_cont_undefined FOREIGN KEY (id_employee_address)
        REFERENCES plataforma_clientes.employee_address (id_employee_address),
    CONSTRAINT fk_id_employee_cont_undefined FOREIGN KEY (id_employee)
        REFERENCES plataforma_clientes.employees (id_employee)
);

