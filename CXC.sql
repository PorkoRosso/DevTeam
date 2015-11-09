CREATE TABLE IF NOT EXISTS `Users`
(
/**`user_id` varchar(40) NOT NULL,**/
`LastName` varchar(255) NOT NULL, 
`FirstName` varchar(255) NOT NULL,
`user_email` varchar(255) NOT NULL,
`user_pass` varchar(40) NOT NULL,
`user_phone` varchar(10) NOT NULL,
UNIQUE (`user_email`),
PRIMARY KEY(`user_email`)
)ENGINE=myISAM;
/**INSERT INTO `Users` (user_id, LastName, FirstName, user_email, user_pass, user_phone) Values
	('abcd1234', 'asfa', 'asf' , 'abcd1234@colorado.edu', 'abcd1234', '111-111-1111');**/

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
/**`user_id` varchar(10) NOT NULL,**/
`user_email` varchar(255) NOT NULL, 
`Item_Name` varchar(255) NOT NULL,
`Item_price` float NOT NULL,
`cat_id` int(1),
`For_sale` int(1),
`For_trade` int(1),
`ipath` varchar(250) NOT NULL, /* Multiple ipath variables for multiple images uploaded*/
PRIMARY KEY(`user_email`)
)ENGINE=myISAM;

/**INSERT INTO `Items` (user_id, Item_Name, Item_price,  cat_id, For_sale, For_trade) Values
	('abcd1234', 'aksdjfad', 39.99,  001, 0, 1);**/
