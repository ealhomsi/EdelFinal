#start fresh
DROP DATABASE edel;

#create a new database called edel
CREATE DATABASE edel;
 
USE edel;
 
#the partners table.
CREATE TABLE Users(
	user_id int not null auto_increment primary key,
	user_name varchar(255),
	user_email varchar(255) not null,
	user_imei varchar(255),
	user_private_key varchar(2050) not null,
	user_public_key varchar(2050) not null,
	user_salt varchar(255) not null,
	user_hashed_password varchar(255) not null,
	user_karma int,
   user_profile_picture MEDIUMBLOB,
	UNIQUE(user_email)
);

#creating an index based on the email address only the first 60 characters
CREATE INDEX UserIndexEmail ON Users(user_email(60));
 

#CREATE THE POST TABLE
CREATE TABLE Posts(
   post_id int not null auto_increment primary key,
   post_type varchar(255),
   post_date Date,
   user_id int not null,
   post_rating int,
   post_text varchar(255),
   FOREIGN KEY (user_id)
   REFERENCES Users(user_id)
   ON UPDATE CASCADE
   ON DELETE RESTRICT
);

#CREATE Father children relationship
CREATE TABLE ChildrenPosts(
	relationship_id int not null auto_increment primary key,
	father_post_id int,
	child_post_id int not null,
	FOREIGN KEY (father_post_id)
	REFERENCES Posts(post_id),
	FOREIGN KEY (child_post_id)
	REFERENCES Posts(post_id)
);

#creating an index for the post rating
CREATE INDEX PostIndexRating ON Posts(post_rating);

#creating an index for the post rating
CREATE INDEX PostIndexPostID ON Posts(post_id);

#CREATE THE DOCUMENTS TABLE
CREATE TABLE Documents(
   document_id int not null auto_increment primary key,
   document_type varchar(255),
   document_size int,
   document_name varchar(255),
   document_content MEDIUMBLOB,
   post_id int not null,
   FOREIGN KEY (post_id)
   REFERENCES Posts(post_id)
   ON UPDATE CASCADE
   ON DELETE RESTRICT
);

#creating an index for the post id
CREATE INDEX DocumentIndexPostID ON Documents(post_id);

#creating a voting system
CREATE TABLE Votes(
   vote_id int not null auto_increment primary key,
   user_id int not null,
   post_id int not null,
   vote_date Date,
   vote_value int,
   FOREIGN KEY (user_id)
   REFERENCES Users(user_id)
   ON UPDATE CASCADE
   ON DELETE RESTRICT,
   FOREIGN KEY (post_id)
   REFERENCES Posts(post_id)
   ON UPDATE CASCADE
   ON DELETE RESTRICT,
   UNIQUE(user_id, post_id)
);

#creating an index for the post id
CREATE INDEX VoteIndexPostID ON Votes(post_id);

#create tags
CREATE TABLE Tags(
	tag_id int not null auto_increment primary key,
	tag_name varchar(255)
);

#create a tagpost table
CREATE TABLE TagPosts(
	tagpost_id int not null auto_increment primary key,
	tag_id int not null,
	post_id int not null,
	FOREIGN KEY (tag_id)
	REFERENCES Tags(tag_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT,
	FOREIGN KEY (post_id)
	REFERENCES Posts(post_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
);

#creating an index for the post id
CREATE INDEX TagPostIndexPostID ON TagPosts(post_id);

/**
#testing
INSERT INTO Users (user_email, user_private_key, user_public_key, user_salt, user_hashed_password) VALUES ('elias@elias.com', '123', '123', '123', '123');

INSERT INTO Posts (user_id, post_text) VALUES (1, "HELLO 1");   #1
INSERT INTO Posts (user_id, post_text) VALUES (1, "HELLO 1.1"); #2

INSERT INTO Posts (user_id, post_text) VALUES (1, "HELLO 2"); 	#3
INSERT INTO Posts (user_id, post_text) VALUES (1, "HELLO 2.1");	#4
INSERT INTO Posts (user_id, post_text) VALUES (1, "HELLO 2.2"); #5

INSERT INTO Posts (user_id, post_text) VALUES (1, "HELLO 2.2.1"); #6

INSERT INTO ChildrenPosts (father_post_id, child_post_id) VALUES (null,1);
INSERT INTO ChildrenPosts (father_post_id, child_post_id) VALUES (null,3);

INSERT INTO ChildrenPosts (father_post_id, child_post_id) VALUES (1,2);


INSERT INTO ChildrenPosts (father_post_id, child_post_id) VALUES (3,4);
INSERT INTO ChildrenPosts (father_post_id, child_post_id) VALUES (3,5);

INSERT INTO ChildrenPosts (father_post_id, child_post_id) VALUES (5,6);
**/