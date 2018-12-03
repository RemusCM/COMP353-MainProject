SET GLOBAL event_scheduler = ON;

CREATE EVENT IF NOT EXISTS monthly_charge_checking
ON SCHEDULE EVERY 1 MONTH
STARTS '2018-12-01 00:00:00'
DO
UPDATE account a
	JOIN checking c ON a.account_number = c.account_number
	JOIN chargeplan cp on c.opt = cp.opt
SET a.balance = balance - cp.charge WHERE a.account_type = 'Checking';


CREATE EVENT IF NOT EXISTS monthly_charge_savings
ON SCHEDULE EVERY 1 MONTH
STARTS '2018-12-01 00:00:00'
DO
UPDATE account a
	JOIN savings s ON a.account_number = s.account_number
	JOIN chargeplan cp on s.opt = cp.opt
SET a.balance = balance - cp.charge WHERE a.account_type = 'Savings';



DELIMITER //
CREATE TRIGGER extraTransaction
AFTER INSERT ON transaction
FOR EACH ROW
BEGIN
UPDATE account a	
JOIN checking c ON a.account_number = c.account_number
JOIN chargeplan cp on c.opt = cp.opt
SET a.balance = a.balance-cp.additional_charge
WHERE a.account_type = 'Checking' AND a.account_number = NEW.account_number AND NEW.account_number IN (SELECT account_number
FROM( SELECT t.account_number, COUNT(*), cp.lim
FROM account a
INNER JOIN checking c ON a.account_number = c.account_number
INNER JOIN chargeplan cp ON c.opt=cp.opt
INNER JOIN transaction t ON a.account_number = t.account_number
where t.date > date_sub(now(), interval 1 month)
GROUP BY t.account_number
HAVING COUNT(*)>cp.lim) AS T);
UPDATE account a	
JOIN savings s ON a.account_number = s.account_number
JOIN chargeplan cp on s.opt = cp.opt
SET a.balance = a.balance-cp.additional_charge
WHERE a.account_type = 'Savings' AND a.account_number = NEW.account_number AND NEW.account_number IN (SELECT account_number
FROM( SELECT t.account_number, COUNT(*), cp.lim
FROM account a
INNER JOIN savings s ON a.account_number = s.account_number
INNER JOIN chargeplan cp ON s.opt=cp.opt
INNER JOIN transaction t ON a.account_number = t.account_number
where t.date > date_sub(now(), interval 1 month)
GROUP BY t.account_number
HAVING COUNT(*)>cp.lim) AS T);
END//
DELIMITER;



SHOW EVENTS;


DROP TRIGGER IF EXISTS extraTransactionChecking;
DROP TRIGGER IF EXISTS extraTransactionSavings;
DROP EVENT IF EXISTS monthly_charge_checking;
DROP EVENT IF EXISTS monthly_charge_savings;

