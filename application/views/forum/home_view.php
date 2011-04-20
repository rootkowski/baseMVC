
<div id="forum-categories">
	<p>Forum Categories: 
		<span>
<?php
foreach( $this->getCategories() as $key => $value ) 
{
	extract($value);
?>
			<a href="?page=forum&cat=<?php echo $id; ?>"><?php echo $this->outputContent($name); ?></a> 
<?
}
?>
		| <a href="?page=start_new_thread">Start New Discussion</a>
		</span>
	</p>
</div>
<div id="module-wrapper">
	<div class="forum_module">
		<h4>Latest Discussions</h4>
		<ul>
<?php
foreach( $this->getLatestThreads() as $key => $value )
{
	extract( $value );
?>
		<li><a href="?page=view_thread&thread_id=<?php echo $t_id; ?>"><?php echo $this->outputContent($title); ?></a></li>
<?php
}
?>	
		</ul>
	</div>

	<div class="forum_module">
		<h4>Latest Posts</h4>
		<ul>
<?php
foreach( $this->getLatestPosts() as $key => $value )
{
	extract( $value );
?>
		<li><a href="?page=view_thread&thread_id=<?php echo $thread_id . '#' . $p_id; ?>"><?php echo $this->outputContent($title); ?></a></li>
<?php
}
?>
		</ul>
	</div>		
</div>

<div class="clr">
  <h3>About This Forum</h3>
  <p>This forum is an example of a database driven application written in accordance to the MVC design pattern. 
  The application uses the basic functionality that baseMVC offers and extends on it.</p>
  <p>Please notice that to be able to use the forum, even for testing, you first need to log in. To do that
  go to the login page and choose the prefered login option from the login names and passwords.</p>
  <p>
  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
  eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
  voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita
  kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem
  ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
  tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
  </p>
  <p>
  vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd
  gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum
  dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
  </p>
  <p>  invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
  eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no
  sea takimata sanctus est Lorem ipsum dolor sit amet.
  </p>
  
  <p>
  Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
  consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et
  accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit
  augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet,
  consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
  laoreet dolore magna aliquam erat volutpat.
  </p>

  <p>
  Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
  lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure
  dolor in hendrerit in vulputate velit esse molestie consequat, vel illum
  dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio
  dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te
  feugait nulla facilisi.
  </p>
	
  <p>
  Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet
  doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet,
  consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
  laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
  nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea
  commodo consequat.
  </p>
  
</div>

<!--details>
  <summary>Discussion</summary>
  <p>
<label for="comment_status"><input
  type="checkbox" checked="checked" value="open"
  id="comment_status" name="comment_status">
  Allow comments.</label><br>
<label for="ping_status"><input
  type="checkbox" value="open" id="ping_status"
  name="ping_status"> Allow trackbacks and
  pingbacks on this page.</label>
  </p>
</details>
<details>
  <summary>Author</summary>
  <p>
<label for="post_author_override">Author</label>
  <select id="post_author_override"
  name="post_author_override">
    <option>Aaron Boodman</option>
    …
    <option>Zak Ruvalcaba</option>
  </select>
  </p>
</details-->