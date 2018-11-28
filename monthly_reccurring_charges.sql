SET GLOBAL event_scheduler = ON;

CREATE EVENT IF NOT EXISTS monthly_charge_checking
ON SCHEDULE EVERY 1 MONTH
STARTS '2018-12-01 00:00:00'
DO
UPDATE account a
	JOIN checking c ON a.account_number = c.account_number
	JOIN chargeplan cp on c.opt = cp.opt
SET a.balance = balance - cp.charge WHERE a.account_type = 'checking';


CREATE EVENT IF NOT EXISTS monthly_charge_savings
ON SCHEDULE EVERY 1 MONTH
STARTS '2018-12-01 00:00:00'
DO
UPDATE account a
	JOIN savings s ON a.account_number = s.account_number
	JOIN chargeplan cp on s.opt = cp.opt
SET a.balance = balance - cp.charge WHERE a.account_type = 'savings';


SHOW EVENTS;

DROP EVENT IF EXISTS monthly_charge_checking;
DROP EVENT IF EXISTS monthly_charge_savings;