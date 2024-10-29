-- events.sql
-- dbname: events_db

-- Create the events table
CREATE TABLE events (
    eventId INT(11) AUTO_INCREMENT PRIMARY KEY, -- Added eventId column
    eventCode INT(11) NOT NULL,
    eventName VARCHAR(50) NOT NULL,
    eventDate DATE NOT NULL,
    eventVenue VARCHAR(100) NOT NULL,
    eventFee DECIMAL(10, 2) NOT NULL,
    UNIQUE (eventCode) -- Ensure eventCode remains unique
);

-- Create the participants table
CREATE TABLE participants (
    participantID INT(11) AUTO_INCREMENT PRIMARY KEY,
    eventCode INT(11),
    partFname VARCHAR(50) NOT NULL,
    partLname VARCHAR(50) NOT NULL,
    DiscountRate DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (eventCode) REFERENCES events(eventCode)
);

-- Create the registration table
CREATE TABLE registration (
    regCode INT(11) AUTO_INCREMENT PRIMARY KEY,
    participantID INT(11),
    regDate DATE NOT NULL,
    regFeePaid DECIMAL(10, 2),
    regPayment VARCHAR(50) NOT NULL,
    FOREIGN KEY (participantID) REFERENCES participants(participantID)
);

-- Trigger to calculate regFeePaid in registration table
DELIMITER $$
CREATE TRIGGER calculate_regFeePaid
BEFORE INSERT ON registration
FOR EACH ROW
BEGIN
    DECLARE event_fee DECIMAL(10, 2);
    DECLARE discount_rate DECIMAL(10, 2);

    -- Get eventFee from the events table
    SELECT e.eventFee INTO event_fee
    FROM events e
    JOIN participants p ON e.eventCode = p.eventCode
    WHERE p.participantID = NEW.participantID;

    -- Get DiscountRate from the participants table
    SELECT DiscountRate INTO discount_rate
    FROM participants
    WHERE participantID = NEW.participantID;

    -- Calculate regFeePaid
    SET NEW.regFeePaid = event_fee - discount_rate;
END $$
DELIMITER ;

-- Sample data insertion
INSERT INTO events (eventCode, eventName, eventDate, eventVenue, eventFee) 
VALUES (1, 'Tech Conference', '2024-11-10', 'Main Hall', 100.00);

INSERT INTO participants (eventCode, partFname, partLname, DiscountRate) 
VALUES (1, 'Test', 'Admin', 20.00);

INSERT INTO registration (participantID, regDate, regPayment) 
VALUES (1, '2024-11-01', 'Cash');
