
-- branch

INSERT INTO Branch VALUES (1, '514-123-1254', '514-123-1435', 'Sally Hanson', '1980-06-15', 'Downtown', 'Montreal');
INSERT INTO Branch VALUES (2, '514-122-3234', '514-127-8235', 'Don Knotts', '1992-11-08', 'Nutana', 'Saskatoon');
INSERT INTO Branch VALUES (3, '514-163-1234', '514-123-4235', 'Tim Bowman', '1990-03-09', 'Riverbend', 'Edmonton');
INSERT INTO Branch VALUES (4, '514-123-1634', '514-123-1735', 'Barry Rye', '1995-10-25', 'Verdun', 'Montreal');
INSERT INTO Branch VALUES (5, '514-123-9234', '514-123-0235', 'Gilbert Cat', '1986-04-06', 'Kanata', 'Ottawa');
INSERT INTO Branch VALUES (6, '514-123-7834', '514-123-1235', 'Jean Eerie', '1988-11-09', 'Oakridge', 'Vancouver');
INSERT INTO Branch VALUES (7, '514-113-1234', '514-163-1235', 'Abraham Cookie', '1987-10-13', 'Scarborough', 'Toronto');
INSERT INTO Branch VALUES (8, '514-333-1234', '514-163-0035', 'Benjamin Turtle', '1988-07-25', 'Horse Hill', 'Edmonton');
INSERT INTO Branch VALUES (9, '514-513-1204', '514-163-9935', 'Spider Man', '2000-03-24', 'Old Toronto', 'Toronto');
INSERT INTO Branch VALUES (10, '514-513-7834', '514-168-1235', 'John Bill', '1999-09-12', 'East York', 'Toronto');
INSERT INTO Branch VALUES (11, '514-123-1234', '514-123-1255', 'Tina Turner', '1985-10-05', 'Cote Des Neiges', 'Montreal');

-- account

INSERT INTO Account VALUES(1, 1, 10000.00, 'Checking', 'Personal Banking', 'Senior', 0.0);
INSERT INTO Account VALUES(2, 1, 10000000.00, 'Savings', 'Corporate Investment', 'Basic', 2.0);
INSERT INTO Account VALUES(3, 2, 3333333.17, 'Savings', 'Business Banking','Basic', 1.5);
INSERT INTO Account VALUES(4, 4, 25000.00,'Line of Credit','Corporate Banking', 'Premium', 4.5);
INSERT INTO Account VALUES(5, 5, 50000.00, 'Line of Credit' , 'Personal Insurance', 'Student', 5.5);
INSERT INTO Account VALUES(6, 3, 0.01, 'Line of Credit', 'Personal Investment', 'Student', 5.5);
INSERT INTO Account VALUES(7, 6, 17.34, 'Line of Credit', 'Personal Banking', 'Student', 5.5);
INSERT INTO Account VALUES(8, 4, 99.99 , 'Savings', 'Personal Insurance', 'Student', 2.0);
INSERT INTO Account VALUES(9, 5, 17171717.17 ,'Savings', 'Business Investment', 'Basic', 3.5);
INSERT INTO Account VALUES(10, 3, 17.17, 'Savings', 'Corporate Banking', 'Premium', 1.5);
INSERT INTO Account VALUES(11, 7, 40.00, 'Savings', 'Business Banking', 'Student', 2.0);
INSERT INTO Account VALUES(12, 7, 1200.00, 'Checking', 'Personal Banking', 'Student', 0.0);
INSERT INTO Account VALUES(13, 6, 40000000.00, 'Savings', 'Business Insurance', 'Basic', 2.4);
INSERT INTO Account VALUES(14, 1, 50000.00, 'Line of Credit', 'Personal Investment', 'Senior', 6.0);
INSERT INTO Account VALUES(15, 7, 11000.00, 'Line of Credit', 'Corporate Banking', 'Student', 5.5);
INSERT INTO Account VALUES(16, 2, 1000.00, 'Line of Credit', 'Personal Banking', 'Student', 4.5);
INSERT INTO Account VALUES(17, 1, 12000.00, 'Credit Card', 'Business Insurance', 'Senior', 20.0);
INSERT INTO Account VALUES(18, 2, 20000.00, 'Checking', 'Personal Banking', 'Student' 0.0);
INSERT INTO Account VALUES(19, 3, 100000.00, 'Checking', 'Personal Banking', 'Premium', 0.0);
INSERT INTO Account VALUES(20, 4, 25000.00, 'Checking', 'Personal Banking', 'Basic', 0.0);
INSERT INTO Account VALUES(21, 5, 35000.00, 'Checking', 'Personal Banking', 'Basic', 0.0);
INSERT INTO Account VALUES(22, 6, 4000.00, 'Checking', 'Personal Banking', 'Basic', 0.0);
INSERT INTO Account VALUES(23, 8, 21000.00, 'Checking', 'Personal Banking', 'Platinum', 0.0);
INSERT INTO Account VALUES(24, 9, 1000.00, 'Savings', 'Personal Banking', 'Student', 2.0);
INSERT INTO Account VALUES(25, 10, 32000.00, 'Savings', 'Personal Banking', 'Senior', 0.0);
INSERT INTO Account VALUES(26, 11, 8000.00, 'Checking', 'Personal Banking', 'Basic', 0.0);
INSERT INTO Account VALUES(27, 12, 23000.00, 'Checking', 'Personal Banking', 'Student', 0.0);
INSERT INTO Account VALUES(28, 13, 7350.00, 'Checking', 'Personal Banking', 'Student', 0.0);
INSERT INTO Account VALUES(29, 14, 17520.00, 'Checking', 'Personal Banking', 'Student', 0.0);
INSERT INTO Account VALUES(30, 15, 6240.00, 'Checking', 'Personal Banking', 'Student', 0.0);
INSERT INTO Account VALUES(31, 16, 43400.00, 'Checking', 'Personal Banking', 'Student', 0.0);
INSERT INTO Account VALUES(32, 17, 45000.00, 'Checking', 'Personal Banking', 'Student', 0.0);
INSERT INTO Account VALUES(33, 12, 1000000.00, 'Mortgage', 'Personal Banking', 'Basic', 2.0);
INSERT INTO Account VALUES(34, 13, 1000.00, 'Credit Card', 'Personal Banking', 'Basic', 21.0);
INSERT INTO Account VALUES(35, 14, 200000.00, 'Loan', 'Corporate Investment', 'Basic', 5.0);
INSERT INTO Account VALUES(36, 15, 4000.00, 'Credit Card', 'Personal Banking', 'Student', 19.0);
INSERT INTO Account VALUES(37, 16, 800.00, 'Credit Card', 'Personal Banking', 'Basic', 21.0);


-- bills

INSERT INTO Bills VALUES (1, 140.0, 0, '2018-11-30', 1);
INSERT INTO Bills VALUES (2, 10.0, 0, '2018-12-10', 1);
INSERT INTO Bills VALUES (3, 58.0, 1, '2018-11-25', 2);
INSERT INTO Bills VALUES (4, 54.0, 1, '2018-11-26', 3);
INSERT INTO Bills VALUES (5, 1000.0, 1, '2018-11-25', 4);
INSERT INTO Bills VALUES (6, 1378.0, 0, '2018-12-30', 5);
INSERT INTO Bills VALUES (7, 154.0, 0, '2018-12-12', 6);
INSERT INTO Bills VALUES (8, 1400.0, 1, '2018-12-21', 7);
INSERT INTO Bills VALUES (9, 870.0, 0, '2018-12-23', 2);
INSERT INTO Bills VALUES (10, 50.0, 0, '2018-11-27', 3);
INSERT INTO Bills VALUES (11, 50.0, 0, '2018-12-18', 4);
INSERT INTO Bills VALUES (12, 135.0, 0, '2018-12-19', 5);
INSERT INTO Bills VALUES (13, 246.0, 1, '2018-12-07', 6);
INSERT INTO Bills VALUES (14, 140.0, 0, '2018-12-23', 7);
INSERT INTO Bills VALUES (15, 50.0, 0, '2018-12-26', 4);
INSERT INTO Bills VALUES (16, 98.0, 0, '2018-12-30', 6);
INSERT INTO Bills VALUES (17, 101.0, 0, '2018-12-30', 16);
INSERT INTO Bills VALUES (18, 60.0, 0, '2018-12-30', 15);
INSERT INTO Bills VALUES (19, 45.0, 0, '2019-01-30', 15);
INSERT INTO Bills VALUES (20, 34.0, 0, '2018-12-12', 16);
INSERT INTO Bills VALUES (21, 500.0, 0, '2018-12-10', 16);


--charge plan

INSERT INTO ChargePlan VALUES ('Student', 5, 5.00, 3.00);
INSERT INTO ChargePlan VALUES ('Premium', 100, 15.00, 1.00);
INSERT INTO ChargePlan VALUES ('Basic', 10, 10.00, 5.00);
INSERT INTO ChargePlan VALUES ('Platinum', 1000, 30.00, 1.00);
INSERT INTO ChargePlan VALUES ('Senior', 15, 0.00, 1.00);



--checking

INSERT INTO Checking VALUES (1, 'Senior');
INSERT INTO Checking VALUES (12, 'Student');
INSERT INTO Checking VALUES (18, 'Student');
INSERT INTO Checking VALUES (19, 'Premium');
INSERT INTO Checking VALUES (20, 'Basic');
INSERT INTO Checking VALUES (21, 'Basic');
INSERT INTO Checking VALUES (22, 'Basic');
INSERT INTO Checking VALUES (23, 'Platinum');
INSERT INTO Checking VALUES (26, 'Basic');
INSERT INTO Checking VALUES (27, 'Student');
INSERT INTO Checking VALUES (28, 'Student');
INSERT INTO Checking VALUES (29, 'Student');
INSERT INTO Checking VALUES (30, 'Student');
INSERT INTO Checking VALUES (31, 'Student');
INSERT INTO Checking VALUES (32, 'Student');


--client

INSERT INTO Client VALUES(1, 'Cherry Neval', '1935-11-12', '1995-12-01', '123 St-Catherine E. Montreal', 'Senior' , 'cherryneval@gmail.com', '1234qwe', '514-687-5723', 1, 0);
INSERT INTO Client VALUES(2, 'Roberto Nial', '1957-06-23', '2001-05-13', '627 Trade Street, Montreal', 'Basic', 'robertonial@gmail.com', '4321qwe', '514-672-9824', 11, 0 );
INSERT INTO Client VALUES(3, 'Naomi Kimber', '1956-05-31', '2017-03-14', '1585 St Ambroise Street, Montreal', 'Basic', 'naomikimber@gmail.com', '2134qwe', '514-175-3759', 11, 1);
INSERT INTO Client VALUES(4, 'Natasha Bier', '1975-02-16', '2010-07-07', '1938 Sherbrooke, Saskatoon', 'Premium', 'natashabier@gmail.com', 'ewq1243', '514-850-2748', 2, 0);
INSERT INTO Client VALUES(5, 'Justin Turtle', '1996-11-12', '1999-12-01', '123 North Street. Edmonton', 'Student', 'justinturtle@gmail.com', 'rew234', '514-239-2348', 3, 0);
INSERT INTO Client VALUES(6, 'Chris Scott', '1995-06-23', '2010-05-13', '6273 Canada Street, Montreal', 'Student', 'chriscott@gmail.com', '423erwer', '514-195-2983', 11, 1);
INSERT INTO Client VALUES(7, 'Noel Hama', '2006-05-31', '2017-03-14', '2857 Nova Avenue, Ottawa', 'Student', 'noelhama@gmail.com', 'rwe3524', '514-583-2938', 11, 0);
INSERT INTO Client VALUES(8, 'Nicola Iber', '2001-02-16', '2013-02-07', '1938 St.Nicolas Avenue, Edmonton', 'Student', 'nicolaiber@gmail.com', 'gsr342', '514-905-2039', 8, 1);
INSERT INTO Client VALUES(9, 'James Hail', '1987-10-04', '1994-01-03', '134 Perrymore, Vancouver', 'Basic', 'jameshail@gmail.com', 'gsret2462', '514-324-2286', 6, 0);
INSERT INTO Client VALUES(10, 'Betty Snow', '1963-04-23', '1988-12-07', '238 Sandle, Toronto', 'Premium', 'bettysnow@gmail.com', 'fasert342', '514-548-9982', 7, 0);
INSERT INTO Client VALUES(11, 'Mandy Moore', '1991-07-12', '2000-08-02', '538 Mayberry Boulevard, Toronto', 'Student', 'mandymoore@gmail.com', 'yte345', '514-443-8725', 9, 0);
INSERT INTO Client VALUES(12, 'Terry Crews', '1999-02-16', '2000-03-07', '543 Travis Street, Toronto', 'Student', 'terrycrews@gmail.com', 'uyt4584','514-923-2229', 10, 0);
INSERT INTO Client VALUES(13, 'Penny Jack', '1979-03-19', '2001-05-13', '938 Rue Tavern, Montreal', 'Basic', 'pennyjack@gmail.com', 'ytety321', '514-765-2879', 4, 0);
INSERT INTO Client VALUES(14, 'Hal Blue', '1930-12-01', '1996-11-07', '154 Rue Pine, Montreal', 'Senior', 'halblue@gmail.com', 'gsf5131', '514-524-3372', 5, 1);
INSERT INTO Client VALUES(15, 'Carl Manning', '1989-02-16', '2005-10-10', '238 Rue Mary, Montreal', 'Student', 'carlmanning@gmail.com', 'fda6135', '514-804-2009', 11, 0);
INSERT INTO Client VALUES(16, 'Connie Yam', '1985-11-21', '2008-10-17', '136 Rue Meadow, Montreal', 'Student', 'connieyam@gmail.com', 'bzcv135', '514-434-3152', 11, 0);
INSERT INTO Client VALUES(17, 'Guy Flower', '1946-09-19', '1990-01-01', '1863 Rue Tab, Montreal', 'Senior', 'guyflower@gmail.com', 'vzd251' '514-901-2882', 11, 0);



--credit

INSERT INTO Credit VALUES(17, 6000.0, 20.0);
INSERT INTO Credit VALUES(34, 2000.0, 10.0);
INSERT INTO Credit VALUES(36, 5000.0, 15.0);
INSERT INTO Credit VALUES(37, 1000.0, 10.0);



--employee

INSERT INTO Employee VALUES(1, 'President', 'Rupaul Charles', '123 de Maisonneuve blvd. Montreal', '1990-10-10', 500000.00, 'rpcharles@gmail.com', '514-145-1415', 5, 4, 1);
INSERT INTO Employee VALUES(2, 'General Manager', 'Blair St-Clair', '345 Mont-Royal St. Montreal', '2000-01-02', 100000.00, 'blairstclair@gmail.com', '514-222-2222', 5, 2, 1);
INSERT INTO Employee VALUES(3, 'General Manager', 'Miss Vanjie', '678 Ste-Catherine St. Montreal', '2000-02-03', 150000.00, 'vanjie@gmail.com' ,  '514-333-3333', 5, 6, 1);
INSERT INTO Employee VALUES(4, 'General Manager', 'Sasha Velour', '910 Peel St.  Montreal', '2001-02-03', 120000.00, 'sashavelour@gmail.com', '514-123-4567', 7, 4, 1);
INSERT INTO Employee VALUES(5, 'General Manager', 'Shae Coulée', '765 Sherbrook blvd.  Montreal', '2002-03-04', 80000.00, 'shaecoulee@gmail.com', '514-321-3322', 3, 2, 1);
INSERT INTO Employee VALUES(6, 'General Manager', 'Jasmine Latendresse', '432 Masson St. Mascouche', '2010-01-03', 250000.00, 'jasminelatendresse@gmail.com', '450-543-4433', 4, 5, 1);
INSERT INTO Employee VALUES(7, 'General Manager', 'Buzz Lightyear', '101 Infinity St. Montreal', '2003-03-04', 91000.00, 'buzzlightyear@gmail.com', '514-555-5555', 5, 6, 1);
INSERT INTO Employee VALUES(8, 'General Manager', 'Filbert Squirrel', '231 Animal Crossing St.  Montreal', '2011-11-30', 50000.00, 'filbertsquirrel@gmail.com', '514-888-9999', 4, 3, 1);
INSERT INTO Employee VALUES(9, 'General Manager', 'Sakura CardCaptor', '108 Desautels St. Montreal', '2013-12-29', 400000.00, 'cardcaptorsakura@gmail.com', '514-890-8090', 2, 6, 1);
INSERT INTO Employee VALUES(10, 'General Manager', 'Sailor Moon', '44 Moon St. Terrebonne', '1999-05-14', 300000.00, 'sailormoon@gmail.com', '450-423-2345', 4, 8, 1);
INSERT INTO Employee VALUES(11, 'Manager', 'Sally Hanson', '54 Doggos St. Mascouche', '1994-05-13', 200000.00, 'sallyhanson@gmail.com', '450-654-3323', 5, 7, 1);
INSERT INTO Employee VALUES(12, 'Manager', 'Don Knotts', '252 Tate St. Saskatoon', '2008-04-20', 210000.00, 'donknotts@gmail.com', '450-987-5555', 3, 6, 2);
INSERT INTO Employee VALUES(13, 'Manager', 'Tim Bowman', '142 River St. Edmonton', '2006-01-28', 300000.00, 'timbowman@gmail.com', '519-965-3213', 6, 3, 3);
INSERT INTO Employee VALUES(14, 'Manager', 'Barry Rye', '100 Hundred St. Montreal', '2016-11-02', 100000.00, 'barryrye@gmail.com', '514-777-8776', 3, 6, 4);
INSERT INTO Employee VALUES(15, 'Manager', 'Gilbert Cat', '564 Cats St. Ottawa', '1994-05-13', 50000.00, 'gilbertcat@gmail.com', '450-433-3323', 4, 10, 5);
INSERT INTO Employee VALUES(16, 'Manager', 'Jean Eerie', '762 Lolli St. Vancouver', '2013-10-14', 230000.00, 'jeaneerie@gmail.com', '450-433-5432', 5, 7, 6);
INSERT INTO Employee VALUES(17, 'Manager', 'Abraham Cookie', '232 Crumble St. Toronto', '2008-04-20', 70000.00, 'abrahamcookie@gmail.com', '450-987-1234', 4, 6, 7);
INSERT INTO Employee VALUES(18, 'Manager', 'Benjamin Turtle', '498 Slow Ride St. Edmonton', '2006-01-28', 80000.00, 'benjaminturtle@gmail.com', '514-983-3213', 3, 6, 8);
INSERT INTO Employee VALUES(19, 'Manager', 'Spider Man', '142 SpiderWeb St. Toronto', '2016-11-02', 90000.00, 'spiderman@gmail.com', '514-223-8876', 3, 5, 9);
INSERT INTO Employee VALUES(20, 'Manager', 'John Bill', '392 Billing St. Toronto', '2013-10-14', 20000.00, 'johnbill@gmail.com', '450-433-3323', 6, 4, 10);
INSERT INTO Employee VALUES(21, 'Manager', 'Tina Turner', '354 Tanner St. Montreal', '2013-10-14', 300000.00, 'tinaturner@gmail.com', '451-433-4444', 5, 5, 11);


--foreignCurrency

INSERT INTO ForeignCurrency VALUES(12, 'Yen');
INSERT INTO ForeignCurrency VALUES(22, 'Rupees');


--loan

INSERT INTO Loan VALUES(4, 50000.0, 'Line of Credit');
INSERT INTO Loan VALUES(5, 100000.0, 'Line of Credit');
INSERT INTO Loan VALUES(6, 5000.0, 'Line of Credit');
INSERT INTO Loan VALUES(7, 5000.0, 'Line of Credit');
INSERT INTO Loan VALUES(14, 75000.0, 'Line of Credit');
INSERT INTO Loan VALUES(15, 50000.0, 'Line of Credit');
INSERT INTO Loan VALUES(16, 10000.0, 'Line of Credit');
INSERT INTO Loan VALUES(33, 1000000.0, 'Mortgage');
INSERT INTO Loan VALUES(35, 250000.0, 'Loan');



--reocurringBills

INSERT INTO ReoccuringBills VALUES(17, 4);
INSERT INTO ReoccuringBills VALUES(19, 12);
INSERT INTO ReoccuringBills VALUES(20, 6);


--savings

INSERT INTO Savings VALUES(2, 'Basic');
INSERT INTO Savings VALUES(3, 'Basic');
INSERT INTO Savings VALUES(8, 'Student');
INSERT INTO Savings VALUES(9, 'Premium');
INSERT INTO Savings VALUES(11, 'Student');
INSERT INTO Savings VALUES(13, 'Basic');
INSERT INTO Savings VALUES(24, 'Student');
INSERT INTO Savings VALUES(25, 'Senior');


--schedule

INSERT INTO Schedule VALUES(1, 'Monday', '11:00', '16:00');
INSERT INTO Schedule VALUES(1, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(1, 'Wednesday', '09:00', '16:00');
INSERT INTO Schedule VALUES(1, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(1, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(2, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(2, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(2, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(2, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(2, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(3, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(3, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(3, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(3, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(3, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(4, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(4, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(4, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(4, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(4, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(5, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(5, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(5, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(5, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(5, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(6, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(6, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(6, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(6, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(6, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(7, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(7, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(7, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(7, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(7, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(8, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(8, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(8, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(8, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(8, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(9, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(9, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(9, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(9, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(9, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(10, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(10, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(10, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(10, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(10, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(11, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(11, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(11, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(11, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(11, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(12, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(12, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(12, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(12, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(12, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(13, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(13, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(13, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(13, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(13, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(14, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(14, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(14, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(14, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(14, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(15, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(15, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(15, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(15, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(15, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(16, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(16, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(17, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(17, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(17, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(18, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(18, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(19, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(19, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(19, 'Friday', '09:00', '17:00');
INSERT INTO Schedule VALUES(20, 'Monday', '09:00', '17:00');
INSERT INTO Schedule VALUES(20, 'Tuesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(21, 'Wednesday', '09:00', '17:00');
INSERT INTO Schedule VALUES(21, 'Thursday', '09:00', '17:00');
INSERT INTO Schedule VALUES(21, 'Friday', '09:00', '17:00');


--service

INSERT INTO Service VALUES('Personal Banking', 3);
INSERT INTO Service VALUES('Corporate Investment', 4);
INSERT INTO Service VALUES('Business Banking', 2);
INSERT INTO Service VALUES('Personal Investment', 5);
INSERT INTO Service VALUES('Personal Insurance', 6);
INSERT INTO Service VALUES('Business Insurance', 7);
INSERT INTO Service VALUES('Corporate Banking', 8);


--transaction

INSERT INTO Transaction VALUES (1, 1, '2018-01-01', 10000.00);
INSERT INTO Transaction VALUES (2, 2, '2018-01-03', 10000000.00);
INSERT INTO Transaction VALUES (3, 3, '2018-03-05', 3333333.17);
INSERT INTO Transaction VALUES (4, 4, '2016-01-07', 25000.00);
INSERT INTO Transaction VALUES (5, 5, '2015-05-08', 50000.00);
INSERT INTO Transaction VALUES (6, 6, '2014-01-01', 0.01);
INSERT INTO Transaction VALUES (7, 7, '2013-05-01', 17.34);
INSERT INTO Transaction VALUES (8, 8, '2018-01-12', 99.99);
INSERT INTO Transaction VALUES (9, 9, '2018-03-01', 17171717.17);
INSERT INTO Transaction VALUES (10, 10, '2018-04-01', 17.17);
INSERT INTO Transaction VALUES (11, 11, '2017-09-13', 40.00);
INSERT INTO Transaction VALUES (12, 12, '2014-05-08', 1200.00);
INSERT INTO Transaction VALUES (13, 13, '2012-06-10', 40000000.00);
INSERT INTO Transaction VALUES (14, 14, '2016-03-21', 50000.00);
INSERT INTO Transaction VALUES (15, 15, '2015-04-12', 11000.00);
INSERT INTO Transaction VALUES (16, 16, '2014-06-15', 1000.00);
INSERT INTO Transaction VALUES (17, 17, '2013-04-24', 1346.00);
INSERT INTO Transaction VALUES (18, 18, '2010-04-24', 3000.00);
INSERT INTO Transaction VALUES (19, 19, '2011-02-04', 134000.00);
INSERT INTO Transaction VALUES (20, 20, '2014-10-16', 100.00);
INSERT INTO Transaction VALUES (21, 21, '2012-07-14', 34.00);
INSERT INTO Transaction VALUES (22, 17, '2012-08-27', 61.00);
INSERT INTO Transaction VALUES (23, 16, '2016-09-22', 6134.00);
INSERT INTO Transaction VALUES (24, 15, '2017-04-21', 12000.00);
INSERT INTO Transaction VALUES (25, 16, '2017-06-12', 613.00);
INSERT INTO Transaction VALUES (26, 17, '2018-05-01', 36.00);
INSERT INTO Transaction VALUES (27, 13, '2015-01-03', 12.00);
INSERT INTO Transaction VALUES (28, 12, '2013-03-26', 65.00);
INSERT INTO Transaction VALUES (29, 7, '2012-04-20', 34.00);
INSERT INTO Transaction VALUES (30, 6, '2013-09-20', 341.00);
INSERT INTO Transaction VALUES (31, 2, '2013-11-28', 341.00);
INSERT INTO Transaction VALUES (32, 13, '2011-08-29', 513.00);
INSERT INTO Transaction VALUES (33, 1, '2010-02-20', 34.00);
INSERT INTO Transaction VALUES (34, 5, '2016-05-12', 1000.00);
INSERT INTO Transaction VALUES (35, 7, '2017-09-14', 51.00);
INSERT INTO Transaction VALUES (36, 9, '2018-09-19', 3000.00);
INSERT INTO Transaction VALUES (37, 10, '2016-03-27', 6520.00);
INSERT INTO Transaction VALUES (38, 4, '2017-12-20', 5100.00);


--admin

INSERT INTO Admin VALUES(1, '1234qwe');
INSERT INTO Admin VALUES(2, '4321qwe');
INSERT INTO Admin VALUES(3, '1234ewq');