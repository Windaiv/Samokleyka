<?php /* VoteItUp skin file */

// Globals issue http://expressionengine.com/knowledge_base/article/my_php_functions_cannot_reference_global_php_variables/ 

global $skinname, $support_images, $support_sinks;
$skinname = 'Graf Thumbs'; //No effect yet, but its good to state
$support_sinks = 'true'; //Only warns the user
$support_images = 'false'; //Only warns the user

function SkinInfo($item) {
global $support_sinks, $support_images;
switch($item) {
case 'supportsinks':
return $support_sinks;
break;
case 'supportimages':
return $support_images;
break;
default:
return 'nothing';
break;

}
}

function LoadVote() {
global $user_ID, $guest_votes, $vote_text, $use_votetext, $allow_sinks;
$postID=get_the_ID();
 ?>
<?php if (function_exists('VoteItUp_options')) { ?>

<?php
$g_arms=true;
if( !UserVoted(get_the_ID(),$user_ID) && !GuestVoted(get_the_ID(),md5($_SERVER['REMOTE_ADDR']))) { 

if ( ($user_ID!="") or (($user_ID=="") and ($guest_votes=="true")) )
{
  $g_arms=false; 

if ($user_ID=="") {$user_ID="0";}
?>

<div id="vote<?php the_ID(); ?>" class="g_votebg" onmouseout="g_up(id,0)">

<a href="javascript:vote_ticker(<?php echo $postID ?>,<?php echo $postID ?>,<?php echo $user_ID; ?>,'<?php echo VoteItUp_ExtPath(); ?>');"> 
  <span class="g_vote"
    onmouseover="g_up('vote<?php the_ID(); ?>',63)"
  ></span>
</a>

<a href="javascript:sink_ticker(<?php echo $postID ?>,<?php echo $postID ?>,<?php echo $user_ID; ?>,'<?php echo VoteItUp_ExtPath(); ?>');">
  <span class="g_vote2" 
    onmouseover="g_up('vote<?php the_ID(); ?>',126)"
  ></span>
</a>

</div>

<? } } ?>

<div id="g_votes<?php the_ID(); ?>" class="g_votesbg" 
  <? if (($allow_sinks=='true') or $g_arms) {echo "style='visibility:visible; position:relative;'";} ?> >
  <? echo $vote_text ?> <span id="g_votec<?php the_ID(); ?>"><?php echo GetVotes($postID); ?></span>
</div>

<?php }
}

function LoadVoteWidget() {
  $a = SortVotes();

  echo '<div class="votewidget_skin"><ul>';

  $rows = 0;

  for ($i = 0; $i < count($a[0]); $i++) {
    if ($rows < 10) {
      if ($a[0][$i][0] != '') {
        $rows++;
        $postdat = get_post($a[0][$i][0]);
        $ssize=$a[1][$i][0]/4+12;
        if ($ssize>=19) {$ssize=19;}
        echo '<li style="font-size:'.$ssize.'px"><b>'.$a[1][$i][0].'</b>.<a href="'.$postdat->guid.'" title="'.$postdat->post_title.'">'.$postdat->post_title.'</a></li>';
				}
      }
}
	

echo '</ul></div>';

}

?>
