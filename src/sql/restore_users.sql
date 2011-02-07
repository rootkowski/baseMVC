create table SiteUserGroups(
id int auto_increment primary key,
name varchar(50)
);

create table SiteUsers(
id int auto_increment primary key,
group_id int,
name varchar(50) unique,
nick varchar(20) unique,
email varchar(256) unique,
user_pass varchar(256),
info text,
location varchar(50),
joined_on datetime,
last_visit datetime,
foreign key (group_id) references SiteUserGroups(id)
ON DELETE CASCADE ON UPDATE CASCADE
);


insert into SiteUserGroups(name) values('superadmin'), ('moderator'), ('blogauthor'), ('member');

insert into SiteUsers(group_id, name, email, user_pass, info, location, joined_on)
	values(1, 'Przemek', 'admin@site.com', md5('adminrules'), 'Super Administrator of the site', 'Midsomer, UK', '2010-05-02 12:30:05'),
		  (3, 'Peter Clarkson', 'clarkson@site.com', md5('clarkson'), 'Product Manager - after work, an excellent goalkeeper.', 'London, UK', '2010-05-02 12:30:05'),
		  (3, 'Jane May', 'may@site.com', md5('may'), 'Service Manager - privately her greatest hobby is climbing.', 'Mansfield, UK', '2010-05-02 12:30:05'),
		  (3, 'Solange Hamilton', 'hamilton@site.com', md5('hamilton'), 'CEO - personally a very kind and inspiring person.', 'Högboträsk, Sweden', '2010-05-02 12:30:05'),
	      (4, 'Phil', 'phil@site.com', md5('123'), '', '', '2010-05-02 19:15:05');
