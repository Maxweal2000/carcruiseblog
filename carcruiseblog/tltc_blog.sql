

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2023 at 05:29 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tltc_blog`
--

-- --------------------------------------------------------

--
-- function: `OBJECT_EXISTS`
--

-- --------------------------------------------------------


DROP FUNCTION IF EXISTS OBJECT_EXISTS;

DELIMITER go


CREATE FUNCTION OBJECT_EXISTS
(	P_NAME  VARCHAR( 255 )
,	P_TYPE  VARCHAR( 255 )
)
RETURNS int
BEGIN

DECLARE V_RETURN_VALUE int	default 0;

DECLARE	V_NAME		VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
DECLARE	V_TYPE		VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci;

DECLARE	V_DOT		INT;

DECLARE	V_SCHEMA_NAME	VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
DECLARE	V_OBJECT_NAME	VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci;


	SET	V_NAME		= IFNULL( P_NAME, 'OBJECT_EXISTS' );
	SET	V_TYPE		= IFNULL( P_TYPE, 'ROUTINE' );

	SET	V_DOT		= INSTR(V_NAME,'.');

	IF	( V_DOT > 1 )
	THEN
	BEGIN
		SET	V_OBJECT_NAME	= SUBSTRING(V_NAME,V_DOT+1);
		SET	V_SCHEMA_NAME	= SUBSTRING(V_NAME,1,V_DOT-1);
	END;
	ELSE
	BEGIN
		SET	V_OBJECT_NAME	= SUBSTRING(V_NAME,V_DOT+1);
		SET	V_SCHEMA_NAME	= DATABASE();
	END;
	END IF;

	IF	( V_TYPE = 'TABLE' )
	THEN
	BEGIN
		SELECT	1
		INTO	V_RETURN_VALUE
		FROM	information_schema.tables
		WHERE	table_schema		= V_SCHEMA_NAME 
		AND	LOWER(table_name)	= V_OBJECT_NAME
		;
	END;
	ELSEIF	( V_TYPE = 'VIEW' )
	THEN
	BEGIN
		SELECT	1
		INTO	V_RETURN_VALUE
		FROM	information_schema.views
		WHERE	table_schema		= V_SCHEMA_NAME	AND	table_name	= V_OBJECT_NAME
		;
	END;
	ELSEIF	( V_TYPE = 'ROUTINE' )
	THEN
	BEGIN
		SELECT	1
		INTO	V_RETURN_VALUE
		FROM	information_schema.routines
		WHERE	routine_schema		= V_SCHEMA_NAME
		AND	specific_name		= V_OBJECT_NAME
		;
	END;
	ELSE 
	BEGIN
		SELECT	1
		INTO	V_RETURN_VALUE
		FROM	information_schema.table_constraints
		WHERE	table_schema		= V_SCHEMA_NAME
		AND	table_name		= V_OBJECT_NAME
		AND	constraint_type		= V_TYPE
		;
	END;
	END IF;

	RETURN 	V_RETURN_VALUE;

END
go

DELIMITER ;

	select	IF( OBJECT_EXISTS( 'OBJECT_EXISTS', 'ROUTINE' ) ,'<<< CREATED ROUTINE "OBJECT_EXISTS" >>>', '<<< FAILED TO CREATE ROUTINE "OBJECT_EXISTS" >>>') AS '';

--	Tests
--	select	OBJECT_EXISTS('USERS_AUDIT', 'TABLE' );
--	select	OBJECT_EXISTS('cm.USERS_AUDIT', 'TABLE' );



DELIMITER go

-- --------------------------------------------------------

--
-- function: `COLUMN_EXISTS`
--

DROP FUNCTION IF EXISTS COLUMN_EXISTS
go

CREATE FUNCTION COLUMN_EXISTS
(	P_TABLE		VARCHAR( 255 )
,	P_COLUMN	VARCHAR( 255 )
)
RETURNS int
BEGIN

DECLARE V_RETURN_VALUE int	default 0;

DECLARE	V_TABLE		VARCHAR(255)	CHARACTER SET utf8 COLLATE utf8_general_ci;
DECLARE	V_COLUMN	VARCHAR(255)	CHARACTER SET utf8 COLLATE utf8_general_ci;

DECLARE	V_DOT		INT;
DECLARE	V_SCHEMA_NAME	VARCHAR(255)	CHARACTER SET utf8 COLLATE utf8_general_ci;
DECLARE	V_OBJECT_NAME	VARCHAR(255)	CHARACTER SET utf8 COLLATE utf8_general_ci;

	SET	V_TABLE		= IFNULL( P_TABLE, '' );
	SET	V_COLUMN	= IFNULL( P_COLUMN, '' );


	SET	V_DOT		= INSTR(V_TABLE,'.');
	IF	( V_DOT > 1 )
	THEN
	BEGIN
		SET	V_OBJECT_NAME	= LOWER(SUBSTRING(V_TABLE,V_DOT+1));
		SET	V_SCHEMA_NAME	= LOWER(SUBSTRING(V_TABLE,1,V_DOT-1));
	END;
	ELSE
	BEGIN
		SET	V_OBJECT_NAME	= LOWER(SUBSTRING(V_TABLE,V_DOT+1));
		SET	V_SCHEMA_NAME	= DATABASE();
	END;
	END IF;

	SELECT	1
	INTO	V_RETURN_VALUE
	FROM	information_schema.columns
	WHERE	table_schema		= V_SCHEMA_NAME
	AND	LOWER(table_name)	= V_OBJECT_NAME
	AND	column_name		= V_COLUMN
	;

	RETURN 	V_RETURN_VALUE;

END
go

DELIMITER ;

	select	IF( OBJECT_EXISTS( 'COLUMN_EXISTS', 'ROUTINE' ) ,'<<< CREATED ROUTINE "COLUMN_EXISTS" >>>', '<<< FAILED TO CREATE ROUTINE "COLUMN_EXISTS" >>>') AS '';

-- --------------------------------------------------------

--
-- function: `get_id_users`
--


DROP FUNCTION IF EXISTS get_id_users;

DELIMITER go

CREATE FUNCTION get_id_users
(	P_EMAIL		TEXT
)
RETURNS	INT
BEGIN

DECLARE	V_ID		INT;

        SELECT	id			id
	INTO	V_ID
	FROM	users			u
        WHERE	email			like	IFNULL(P_EMAIL,'')
	ORDER	BY ID DESC
        LIMIT	1
	;

	RETURN	V_ID;

END
go

DELIMITER ;

	select	IF( OBJECT_EXISTS( 'get_id_users', 'ROUTINE' ) ,'<<< CREATED ROUTINE "get_id_users" >>>', '<<< FAILED TO CREATE ROUTINE "get_id_users" >>>') AS '';

-- --------------------------------------------------------


--
-- function: `get_email_users`
--


DROP FUNCTION IF EXISTS get_email_users;

DELIMITER go

CREATE FUNCTION get_email_users
(	P_ID		INT
)
RETURNS	TEXT
BEGIN

DECLARE	V_EMAIL		INT;

        SELECT	email
	INTO	V_EMAIL
	FROM	users			u
        WHERE	id			=	P_ID
	ORDER	BY ID DESC
        LIMIT	1
	;

	RETURN	V_EMAIL;

END
go

DELIMITER ;

	select	IF( OBJECT_EXISTS( 'get_email_users', 'ROUTINE' ) ,'<<< CREATED ROUTINE "get_email_users" >>>', '<<< FAILED TO CREATE ROUTINE "get_email_users" >>>') AS '';

-- --------------------------------------------------------


--
-- function: `get_id_roles`
--


DROP FUNCTION IF EXISTS get_id_roles;

DELIMITER go

CREATE FUNCTION get_id_roles
(	P_NAME		TEXT
)
RETURNS	INT
BEGIN

DECLARE	V_ID		INT;

DECLARE	V_LOGIN_ID	INT;
DECLARE	V_USERNAME	TEXT;
DECLARE	V_PASSWORD	TEXT;

        SELECT	id
	INTO	V_ID
	FROM	roles			u
        WHERE	name			like	IFNULL(P_NAME,'')
	ORDER	BY ID DESC
        LIMIT	1
	;

	RETURN	V_ID;

END
go

DELIMITER ;

	select	IF( OBJECT_EXISTS( 'get_id_roles', 'ROUTINE' ) ,'<<< CREATED ROUTINE "get_id_roles" >>>', '<<< FAILED TO CREATE ROUTINE "get_id_roles" >>>') AS '';

-- --------------------------------------------------------


--
-- function: `get_name_roles`
--


DROP FUNCTION IF EXISTS get_name_roles;

DELIMITER go

CREATE FUNCTION get_name_roles
(	P_ID		INT
)
RETURNS	TEXT
BEGIN

DECLARE	V_NAME		TEXT;

        SELECT	name
	INTO	V_NAME
	FROM	roles			u
        WHERE	id			=	P_ID
	ORDER	BY ID DESC
        LIMIT	1
	;

	RETURN	V_NAME;

END
go

DELIMITER ;

	select	IF( OBJECT_EXISTS( 'get_name_roles', 'ROUTINE' ) ,'<<< CREATED ROUTINE "get_name_roles" >>>', '<<< FAILED TO CREATE ROUTINE "get_name_roles" >>>') AS '';

-- --------------------------------------------------------

--
-- function: `get_login`
--


DROP FUNCTION IF EXISTS get_login;

DELIMITER go

CREATE FUNCTION get_login
(	P_EMAIL		TEXT
,	P_PASSWORD	TEXT
)
RETURNS	INT
BEGIN

DECLARE	V_ID		INT;


        SELECT	u.id
	INTO	V_ID
	FROM	USERS			u
        WHERE	u.email			=	P_EMAIL
        AND	u.password		=	P_PASSWORD
        AND	u.is_suspeneded		=	0
        LIMIT	1
	;

	RETURN	V_ID;

END
go

DELIMITER ;

	select	IF( OBJECT_EXISTS( 'get_login', 'ROUTINE' ) ,'<<< CREATED ROUTINE "get_login" >>>', '<<< FAILED TO CREATE ROUTINE "get_login" >>>') AS '';

-- --------------------------------------------------------

CREATE TABLE `articles`
(	`id`			int		NOT NULL	AUTO_INCREMENT
,	`title`			varchar(50) COLLATE latin1_general_ci	NOT NULL
,	`article`		longtext COLLATE latin1_general_ci	NOT NULL
,	`create_date`		timestamp	NOT NULL	DEFAULT CURRENT_TIMESTAMP
,	`update_date`		timestamp	NOT NULL	DEFAULT CURRENT_TIMESTAMP
,	`create_user`		int		NOT NULL
,	`update_user`		int		NOT NULL
,	PRIMARY KEY (`id`)
,	UNIQUE KEY (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci
;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments`
(	`id`			int		NOT NULL	AUTO_INCREMENT
,	`article_id`		int		NULL
,	`parent_comment_id`	int		NULL
,	`title`			varchar(50) COLLATE latin1_general_ci	NOT NULL
,	`comment`		longtext	NOT NULL	COLLATE latin1_general_ci
,	`create_date`		timestamp	NOT NULL	DEFAULT CURRENT_TIMESTAMP
,	`update_date`		timestamp	NOT NULL	DEFAULT CURRENT_TIMESTAMP
,	`create_user`		int		NOT NULL
,	`update_user`		int		NOT NULL
,	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci
;


-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company`
(	`id`			int		NOT NULL	AUTO_INCREMENT
,	`name`			varchar(255)	NOT NULL	COLLATE latin1_general_ci
,	`email`			varchar(255)	NULL	COLLATE latin1_general_ci
,	`phone_Number`		varchar(255)	NULL        COLLATE latin1_general_ci
,	`address_line_1`	varchar(255)	NULL	COLLATE latin1_general_ci
,	`address_line_2`	varchar(255)	NULL	COLLATE latin1_general_ci
,	`address_line_3`	varchar(255)	NULL	COLLATE latin1_general_ci
,	`town`			varchar(255)	NULL	COLLATE latin1_general_ci
,	`city`			varchar(255)	NULL	COLLATE latin1_general_ci
,	`county`		varchar(255)	NULL	COLLATE latin1_general_ci
,	`country`		varchar(255)	NULL	COLLATE latin1_general_ci
,	`postcode`		varchar(255)	NULL	COLLATE latin1_general_ci
,	`create_date`		timestamp	NOT NULL	DEFAULT CURRENT_TIMESTAMP
,	`update_date`		timestamp	NOT NULL	DEFAULT CURRENT_TIMESTAMP
,	`create_user`		int		NOT NULL
,	`update_user`		int		NOT NULL
,	PRIMARY KEY (`id`)
,	UNIQUE KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci
;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(	`id`			int		NOT NULL	auto_increment
,	`email`			varchar(255)	NOT NULL	COLLATE latin1_general_ci
,	`role_id`			int		NULL	-- get_id_roles('writer')
,	`first_name`		varchar(255)	NULL	COLLATE latin1_general_ci
,	`last_name`		varchar(255)	NULL	COLLATE latin1_general_ci
,	`address1`		varchar(255)	NULL	COLLATE latin1_general_ci
,	`postcode`		varchar(255)	NULL	COLLATE latin1_general_ci
,	`password`		varchar(255)	NULL	COLLATE latin1_general_ci
,	`is_suspended`		tinyint(1)	NOT NULL	DEFAULT '0' COMMENT '0=not suspended, 1=suspended'
,	`create_date`		timestamp	NOT NULL	DEFAULT CURRENT_TIMESTAMP
,	`update_date`		timestamp	NOT NULL	DEFAULT CURRENT_TIMESTAMP
,	`create_user`		int		NULL
,	`update_user`		int		NULL
,	PRIMARY KEY (`id`)
,	UNIQUE KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci
;

 

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles`
(	`id`			int		NOT NULL	AUTO_INCREMENT
,	`name`			varchar(255)	NOT NULL	COLLATE latin1_general_ci
,	`create_date`		timestamp	NOT NULL	DEFAULT CURRENT_TIMESTAMP
,	`update_date`		timestamp	NOT NULL	DEFAULT CURRENT_TIMESTAMP
,	`create_user`		int		NOT NULL
,	`update_user`		int		NOT NULL
,	PRIMARY KEY (`id`)
,	UNIQUE KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci
;

-- --------------------------------------------------------


-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`create_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`update_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`parent_comment_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`create_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`update_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`create_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `roles_ibfk_2` FOREIGN KEY (`update_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`create_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`update_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);


-- --------------------------------------------------------
--
-- Table data for table `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `password`, `email` ) VALUES
('admin', 'admin', null, 'admin@example.com');

update users
set	create_user	=	get_id_users('admin')
,	update_user	=	get_id_users('admin')
WHERE	email		=	'admin@example.com'
;

INSERT INTO `users` ( `first_name`, `last_name`, `password`, `email` , create_user, update_user )
VALUES	('reader', 'reader' , null, 'reader@example.com', get_id_users('admin'), get_id_users('admin') );

--
-- Table data for table `roles`
--

INSERT INTO `roles` ( `name`, create_user, update_user) VALUES
('admin', get_id_users('admin@example.com') , get_id_users('admin@example.com') );

INSERT INTO `roles` ( `name`, create_user, update_user) VALUES
('reader', get_id_users('admin@example.com') , get_id_users('admin@example.com') );

INSERT INTO `roles` ( `name`, create_user, update_user) VALUES
('writer', get_id_users('admin@example.com') , get_id_users('admin@example.com') );

--
-- Alter table `users`
--
update users
set	role_id		=	get_id_roles('admin')
WHERE	email	=	'admin@example.com'
;

-- select * from users ;
ALTER TABLE `users`
MODIFY create_user int NOT NULL 
;

ALTER TABLE `users`
MODIFY update_user int NOT NULL 
;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
