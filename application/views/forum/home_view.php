
<div>
	<h4>Forum Categories: 
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
		| <a href="?page=thread&do=start_new_thread">Start New Discussion</a>
		</span>
	</h4>
</div>

<div class="forum_module">
	<h4>Latest Discussions</h4>
	<ul>
<?php
foreach( $this->getLatestThreads() as $key => $value )
{
	extract( $value );
?>
		<li><a href="?page=thread&do=view_thread&thread_id=<?php echo $t_id; ?>"><?php echo $this->outputContent($title); ?></a></li>
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
		<li><a href="?page=thread&do=view_thread&thread_id=<?php echo $thread_id . '#' . $p_id; ?>"><?php echo $this->outputContent($title); ?></a></li>
<?php
}
?>
	</ul>
</div>	

<div class="clr">
  <h3>About This Forum</h3>
  <p>This forum is an example of a database driven application written in accordance to the MVC design pattern. 
  The application uses the basic functionality that baseMVC offers and extends on it.</p>
  <p>Please notice that to be able to use the forum, even for testing, you first need to log in. To do that
  go to the login page and choose the prefered login option from the login names and passwords.</p>
</div>