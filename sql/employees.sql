

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
    status VARCHAR(1) DEFAULT 'A' NOT NULL,
    created_at timestamp default current_timestamp,
    updated_at timestamp
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

CREATE TABLE plataforma_clientes.contract(
    id_contract INT AUTO_INCREMENT PRIMARY KEY,
    id_employee INT NOT NULL,
    begin_contract DATETIME NOT NULL,
    end_contract DATETIME NOT NULL,
    weekly_balance FLOAT NOT NULL,
    punctuality_award FLOAT NOT NULL,
    assistance_award FLOAT NOT NULL,
    daily_balance FLOAT NOT NULL,
    contract_created DATE NOT NULL,
    created_at timestamp default current_timestamp,
    updated_at timestamp null,
    CONSTRAINT fk_id_employee_contract FOREIGN KEY (id_employee)
        REFERENCES plataforma_clientes.employees (id_employee)
);

