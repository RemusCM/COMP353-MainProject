-- Branch --
CREATE TABLE Branch (
	branch_id INT NOT NULL AUTO_INCREMENT,
	phone VARCHAR(12),
	fax VARCHAR(12),
	manager_name VARCHAR(255),
	opening_date DATE,
	area VARCHAR(255),
	city VARCHAR(255),
	PRIMARY KEY (branch_id)
);

-- Employee --
CREATE TABLE Employee (
	employee_id INT NOT NULL AUTO_INCREMENT,
	title VARCHAR(255),
	name VARCHAR(255),
	address VARCHAR(255),
	start_date DATE,
	salary DOUBLE(15, 2),
	email_address VARCHAR(255),
	phone_number VARCHAR(12),
	holidays INT,
	sick_days INT,
	branch_id INT,
	PRIMARY KEY (employee_id),
	FOREIGN KEY (branch_id) REFERENCES Branch(branch_id)
);

-- Schedule --
CREATE TABLE Schedule (
	employee_id INT NOT NULL AUTO_INCREMENT,
	day VARCHAR(255),
	start_time VARCHAR(12),
	end_time VARCHAR(12),
	FOREIGN KEY (employee_id) REFERENCES Employee(employee_id),
	PRIMARY KEY (employee_id, day)
);

-- Client --
CREATE TABLE Client (
	client_id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	date_of_birth DATE,
	joining_date DATE,
	address VARCHAR(255),
	category VARCHAR(255),
	email_address VARCHAR(255),
	password VARCHAR(255),
	phone_number VARCHAR(12),
	branch_id INT,
	is_notified BIT,
	PRIMARY KEY (client_id),
	FOREIGN KEY (branch_id) REFERENCES Branch(branch_id)
);

-- Bills --
CREATE TABLE Bills (
	bill_id INT NOT NULL AUTO_INCREMENT,
	amount DOUBLE(15, 2),
	is_paid BIT,
	date DATE,
	client_id INT,
	PRIMARY KEY (bill_id),
	FOREIGN KEY (client_id) REFERENCES Client(client_id)
);

-- ReoccurringBills --
CREATE TABLE ReoccurringBills (
	bill_id INT,
	reoccurrence INT,
	PRIMARY KEY (bill_id),
	FOREIGN KEY (bill_id) REFERENCES Bills(bill_id)
);

-- Service --
CREATE TABLE Service (
	service_type VARCHAR(255),
	manager_id INT NOT NULL,
	PRIMARY KEY (service_type),
	FOREIGN KEY (manager_id) REFERENCES Employee(employee_id)
);

-- ChargePlan --
CREATE TABLE ChargePlan (
	opt VARCHAR(255),
	lim DOUBLE(15, 2),
	charge DOUBLE(15, 2),
	additional_charge DOUBLE(15,2),
	PRIMARY KEY (opt)
);

-- Account --
CREATE TABLE Account (
	account_number INT NOT NULL AUTO_INCREMENT,
	client_id INT,
	balance DOUBLE(15,2),
	account_type VARCHAR(255),
	service_type VARCHAR(255),
	option_name VARCHAR(255),
	interest_rate INT,
	PRIMARY KEY (account_number),
	FOREIGN KEY (service_type) REFERENCES Service(service_type),
	FOREIGN KEY (client_id) REFERENCES Client(client_id)
);

-- Foreign Currency --
CREATE TABLE ForeignCurrency (
	account_number INT,
	currency_type VARCHAR(255),
	PRIMARY KEY (account_number),
	FOREIGN KEY (account_number) REFERENCES Account(account_number)
);

-- Credit --
CREATE TABLE Credit (
	account_number INT,
	credit_limit DOUBLE(15, 2),
  minimal_payment DOUBLE(15,2),
	PRIMARY KEY (account_number),
	FOREIGN KEY (account_number) REFERENCES Account(account_number)
);

-- Loan --
CREATE TABLE Loan (
	account_number INT,
	loan_limit DOUBLE(15,2),
	type VARCHAR(255),
	PRIMARY KEY (account_number),
	FOREIGN key (account_number) REFERENCES Account(account_number)
);

-- Savings --
CREATE TABLE Savings (
	account_number INT,
	opt VARCHAR(255),
	PRIMARY KEY (account_number),
	FOREIGN key (account_number) REFERENCES Account(account_number),
	FOREIGN KEY (opt) REFERENCES ChargePlan(opt)
);

-- Checking --
CREATE TABLE Checking (
	account_number INT,
	opt VARCHAR(255),
	PRIMARY KEY (account_number),
	FOREIGN KEY (account_number) REFERENCES Account(account_number),
	FOREIGN KEY (opt) REFERENCES ChargePlan(opt)
);

-- Transaction --
CREATE TABLE Transaction (
	transaction_number INT NOT NULL AUTO_INCREMENT,
	account_number INT,
	date DATE,
	amount DOUBLE(15, 2),
	PRIMARY KEY (transaction_number),
	FOREIGN KEY (account_number) REFERENCES Account(account_number)
);
