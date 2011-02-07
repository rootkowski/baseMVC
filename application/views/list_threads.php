<?php
/* 
 * View a list of threads 
 */

extract($threads);

?>
<table>
	<tr>
		<th>Thread</th>
		<th>Last Post</th>
		<th>Replies</th>
	</tr>
	<tr>
		<td>echo title as link to ?page=forum&amp;thread=thread_id by person who started the thread</td>
		<td>datetime of latest post and name of author</td>
		<td>number of replies</td>
	</tr>
</table>