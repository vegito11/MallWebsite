CREATE database shop;
use shop;
drop database shop;
CREATE table customers
(
	cust_id int ,
    cust_name varchar(128) unique not null,
    cust_phone varchar(13) unique not null,
    cust_address varchar(128),
    cust_email varchar(128) unique not null,
    cust_gen varchar(1),
    cust_date date,
    cust_active date,
    primary key(cust_id)
);

CREATE table employee
(
	emp_id int ,
    emp_f_name varchar(28),
    emp_l_name varchar(28),
    emp_address varchar(128),
    emp_phone varchar(13) unique not null,    
    emp_email varchar(128) unique not null,
    emp_sal double,
    emp_dob date not null,
    emp_gen varchar(1),
    Date_joined date not null,    
    primary key(emp_id)
);


CREATE TABLE employee_type
(
	et_id int unique not null,
    et_title varchar(10),
    et_desc varchar(10),    
    et_active date,
    foreign key(et_id) references employee(emp_id)
);


create table products 
(
	pro_id int,
	pro_name varchar(128),
    pro_manu_date date not null,
    pro_expire_dat date ,
    pro_pur_price float,
    pro_sal_price float,    
    primary key(pro_id)
);

create table stock
(
	st_id int,
    st_name varchar(128),
    st_comp varchar(128),
    st_type varchar(30),
    st_quen double,
    foreign key (st_id)  references products(pro_id) 
);

create table checkout
(
	cust_id int  not null,
	emp_id int  not null,
    pro_id int not null ,
    pro_nm varchar(128),
    quen double,
    pur_date date,
    price float not null
);
create table login
(
    log_type varchar(128) not null    ,        
    log_username varchar(128) unique not null,
    log_password varchar(128) unique not null
);
