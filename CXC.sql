CREATE TABLE IF NOT EXISTS `Users`
(
`user_id` varchar(40) NOT NULL,
`LastName` varchar(255) NOT NULL,
`FirstName` varchar(255) NOT NULL,
`user_email` varchar(255) NOT NULL,
UNIQUE (`user_id`),
PRIMARY KEY(`user_id`)
)ENGINE=myISAM;
INSERT INTO `Users` (user_id, LastName, FirstName, user_email) Values
	('abcd1234', 'asfa', 'asf' , 'abcd1234@colorado.edu');

CREATE TABLE IF NOT EXISTS `Categories`
(
`cat_id` int(1) NOT NULL,
`cat_name` varchar(255) NOT NULL,
PRIMARY KEY(`cat_id`)
)ENGINE=myISAM;

INSERT INTO `Categories` (cat_id, cat_name) VALUES
	(001, 'Clothing'),
	(002, 'Furniture'),
	(003, 'Tech'),
	(004, 'Housing');
CREATE TABLE IF NOT EXISTS `Items`
(
`user_id` varchar(10) NOT NULL,
`Item_Name` varchar(255) NOT NULL,
`cat_id` int(1),
`For_sale` int(1),
`For_trade` int(1),
PRIMARY KEY(`user_id`)
)ENGINE=myISAM;

INSERT INTO `Items` (user_id, Item_Name, cat_id, For_sale, For_trade) Values
	('abcd1234', 'aksdjfad', 001, 0, 1);
