create table ForumCategories(
id int auto_increment primary key,
name varchar(30)
);

create table ForumThreads(
t_id int auto_increment primary key,
title varchar(150),
started_by int,
started_on datetime,
category int,
write_status boolean,
foreign key (started_by) references SiteUsers(id)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (category) references ForumCategories(id)
ON DELETE CASCADE ON UPDATE CASCADE
);

create table ForumPosts(
p_id int auto_increment primary key,
thread_id int,
title varchar(150),
message text,
posted_by int,
posted_on datetime,
foreign key (thread_id) references ForumThreads(t_id)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (posted_by) references SiteUsers(id)
ON DELETE CASCADE ON UPDATE CASCADE
);

create table ForumDrafts(
d_id int auto_increment primary key,
thread_id int,
author_id int,
content_id int,
draft_title varchar(150),
draft_text text,
draft_saved datetime,
draft_state varchar(20)
);

insert into ForumCategories(name) values('General'), ('PHP'), ('MySQL');

insert into ForumThreads(title, started_by, started_on, category, write_status) 
	values('General Rules of The Forum', 1, '2010-05-02 12:45:05', 1, TRUE), 
	      ('Need help with PHP', 2, '2010-05-03 19:45:05', 2, TRUE);

insert into ForumPosts(thread_id, title, message, posted_by, posted_on) 
	values(1, 'General Rules of The Forum', 'Be Nice, Be Kind!', 1, '2010-05-02 12:45:05'), 
	      (2, 'Need help with PHP', 'I have a problem, please help!', 2, '2010-05-03 19:45:05'), 
	      (2, 'Re: Need help with PHP', 'What is your problem?', 1, '2010-05-03 20:45:05');
	      
insert into ForumDrafts(thread_id, author_id, draft_title, draft_text, draft_saved, draft_state)
	values(2, 5, 'Re: Need help with PHP', 'Please tell us more about it!', '2010-11-14 12:33:52', 'draft'),
		  (2, 5, 'Re: Need help with PHP', 'Please tell us more about it!', '2010-11-30 12:33:52', 'draft'),
		  (2, 3, 'Re: Need help with PHP', 'Please tell us more about it!', '2010-11-14 12:33:52', 'draft');