create table ForumStats(
id int auto_increment not null primary key,
uid int not null,
postNum int default 0);


create table ThreadStats(
id int auto_increment not null primary key,
tid int not null,
postNum int default 0);


insert into ForumStats(uid, postNum)
values(1, 2), (2, 1), (3, 0), (4, 0), (5, 0);

insert into ThreadStats(tid, postNum)
values(1, 1), (2, 2);
