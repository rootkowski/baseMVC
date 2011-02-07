create procedure ViewThread
(IN in_thread_id INT)
begin
	SELECT * FROM ForumPosts, SiteUsers, ForumStats
	WHERE thread_id = in_thread_id
	AND posted_by = SiteUsers.id
	AND uid = SiteUsers.id
	ORDER BY posted_on ASC;
end;


create procedure GetThreadCategory 
( IN in_thread_id integer)

reads sql data
begin
	SELECT ForumCategories.name 
	FROM ForumCategories, ForumThreads 
	WHERE t_id = in_thread_id AND ForumCategories.id = category LIMIT 1;
end;


create procedure SubmitPost
(IN in_thread_id INT, in_title VARCHAR(150), in_message TEXT, in_posted_by INT)
begin
    INSERT INTO ForumPosts(thread_id, title, message, posted_by, posted_on)
    VALUES(in_thread_id, in_title, in_message, in_posted_by, NOW());
end;


create procedure GetPostToEdit
(IN post_id INT)
begin
	select * from ForumPosts where p_id = post_id;
end;


create procedure SubmitEditedPost
(IN in_title VARCHAR(150), in_message TEXT, post_id INT)
modifies sql data
begin
	update ForumPosts
	set
		title = in_title,
		message = in_message
	WHERE p_id = post_id;
end;


create procedure getUserPosts
(IN in_user_id INT)
begin
	select * from ForumPosts where posted_by = in_user_id order by posted_on DESC;
end;


create function AuthoriseForumUser
( in_content_id INT, in_user_id INT ) 
RETURNS BOOLEAN
reads sql data
BEGIN
	DECLARE author_id INT;
	DECLARE user_group VARCHAR(50);

	SELECT posted_by INTO author_id FROM ForumPosts WHERE p_id = in_content_id;

	SELECT SiteUserGroups.name INTO user_group 
	FROM SiteUserGroups, SiteUsers 
	WHERE SiteUserGroups.id = group_id 
	AND SiteUsers.id = in_user_id;

	IF author_id = in_user_id THEN
		RETURN TRUE;

	ELSEIF user_group = 'superadmin' THEN
		RETURN TRUE;

	ELSEIF user_group = 'moderator' THEN
		RETURN TRUE;

	ELSE
		RETURN FALSE;

	END IF;
END;


create function AuthoriseBlogUser
( in_content_id INT, in_user_id INT ) RETURNS BOOLEAN
BEGIN
	DECLARE author_id INT;
	DECLARE user_group VARCHAR(50);

	SELECT authorId INTO author_id FROM BlogContent WHERE id_Content = in_content_id;
	SELECT SiteUserGroups.name INTO user_group FROM SiteUserGroups, SiteUsers WHERE SiteUserGroups.id = group_id AND SiteUsers.id = in_user_id;

	IF author_id = in_user_id THEN
		RETURN TRUE;

	ELSEIF user_group = 'superadmin' THEN
		RETURN TRUE;

	ELSE
		RETURN FALSE;

	END IF;
END;


create function AuthoriseBlogWriter
( in_user_id INT ) RETURNS BOOLEAN
BEGIN
	DECLARE user_group VARCHAR(50);

	SELECT SiteUserGroups.name INTO user_group FROM SiteUserGroups, SiteUsers WHERE SiteUserGroups.id = group_id AND SiteUsers.id = in_user_id;

	IF user_group = 'blogauthor' THEN
		RETURN TRUE;

	ELSE
		RETURN FALSE;

	END IF;
END;


create trigger NewUserStats
after insert on SiteUsers
for each row
begin
	insert into ForumStats set uid = new.id;
end;


create trigger NewThreadStats
after insert on ForumThreads
for each row
begin
	insert into ThreadStats set tid = new.t_id;
end;


create trigger AddNewPost
after insert on ForumPosts
for each row
begin
	update ForumStats set postNum = postNum + 1 where uid = new.posted_by;
	update ThreadStats set postNum = postNum + 1 where tid = new.thread_id;
end;


create trigger DeletePost
after delete on ForumPosts
for each row
begin
	update ForumStats set postNum = postNum - 1 where uid = old.posted_by;
	update ThreadStats set postNum = postNum - 1 where tid = old.thread_id;
end;
