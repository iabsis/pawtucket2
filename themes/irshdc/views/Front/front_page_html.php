<?php
/** ---------------------------------------------------------------------
 * themes/default/Front/front_page_html : Front page of site 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * @package CollectiveAccess
 * @subpackage Core
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
 	require_once(__CA_LIB_DIR__.'/ca/Search/EntitySearch.php');
 	$this->config = caGetFrontConfig();
 	AssetLoadManager::register('timeline');
 	$va_access_values = $this->getVar("access_values");
 	 	
# --- timeline set - occurrences
	if($vs_timeline_set_code = $this->config->get("front_page_timeline_set_code")){
		$t_set = new ca_sets();
		$t_set->load(array('set_code' => $vs_timeline_set_code));
		$vn_timeline_set_id = $t_set->get("set_id");
		$o_occ_context = new ResultContext($this->request, 'ca_occurrences', 'front');
		$o_occ_context->setAsLastFind();
		$o_occ_context->setResultList(array_keys($t_set->getItemRowIDs()));
		$o_occ_context->saveContext();
	}
# --- get the narrative threads to link to browses
	$t_list = new ca_lists();
	$va_narrative_threads = $t_list->getItemsForList("narrative_thread", array("extractValuesByUserLocale" => true));
#print_r($va_narrative_threads);	
?>
	<div class="row frontSearchRow">
		<div class="col-sm-12 frontSearchCol">
				<form role="search" class="form-inline" action="<?php print caNavUrl($this->request, '', 'MultiSearch', 'Index'); ?>">
					<div class="formOutline">
						<div class="form-group form-group-lg">
							<input class="form-control" placeholder="Search the collection" name="search" type="text">
						</div>
						<button type="submit" class="btn-search"><span class="glyphicon glyphicon-search"></span></button>
					</div>
				</form>

		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
<?php
		$va_quotes = array(
			"\"Many of us, through our pain and suffering, managed to hold our heads up ... We were brave children.\"<div class='byline'>– Barney Williams, Kamloops School Survivor</div>",
			"\"[T]hey did not break my spirit.... This journey we will walk together. This Dialogue has started the support, being there for each other, sharing what we learned and also our pain. That is who we are.\"<div class='byline'>–  Angie Crerar, Survivor</div>",
			"\"And until people show that they have learned from this, we will never forget, and we should never forget, even once they have learned from it, because this is part of who we are.\"<div class='byline'>– Senator Murray Sinclair</div>",
			"\"First, the Survivors need to know before they leave this earth that people understand what happened and what the schools did to them. Second, the Survivors need to know that, having been heard and understood, that we will act to ensure the repair of damages done.\"<div class='byline'>– Senator Murray Sinclair</div>",
			"\"[E]ven though you have family, you still feel separated, you still, you don't have a name, you don't have an identity, you just have a number, and mine was 56.\"<div class='byline'>– Antonette White, Kuper Island School Survivor</div>",
			"\"[T]here's value in our knowledge, there's value in our culture, there's value in our ways as a community, and that really matters, that it does make a difference, and that we cannot put that responsibility aside…It's a responsibility of everyone who lives on this land and that has colonized it and benefited from it, to make that right.\"<div class='byline'>– Jeannette Armstrong</div>"
		);
		$vs_quote = $va_quotes[array_rand($va_quotes)];
?>
			<br/>
			<br/>
			<br/>
			<H1><?php print $vs_quote; ?></H1>
			<br/>
			<br/>
			<br/>
		</div>
	</div>
	<div class="row blackBg primer">
		<div class="col-sm-5 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1">
			<H2><?php print caNavLink($this->request, "Resources", "", "", "Listing", "Resources"); ?></H2>
			<H3>Perspectives, stories and dialogues</H3>
			<br/>
			<p>
				Explore a continually growing set of resources that explore the historical context of settler colonialism in Canada and foundational themes relating to the history of the Indian Residential School System, Indigenous histories, contemporary realities, and futures.
			</p>
			<p class="text-center">
				<br/><?php print caNavLink($this->request, "MORE", "btn-default outline", "", "Listing", "Resources"); ?>
			</p>
		</div>
		<div class="col-sm-7 col-sm-offset-0 col-md-6 col-md-offset-0 col-lg-5 col-lg-offset-1 bleed">
			<?php print caNavLink($this->request, caGetThemeGraphic($this->request, 'centre6.jpg'), "", "", "Listing", "Resources"); ?>
		</div>
	</div>
<?php
	if($vn_timeline_set_id){

?>
	<div class="row">
		<div class="col-sm-12">
			<div id="frontTimelineContainer">
				<div id="timeline-embed"></div>
			</div>
	
			<script type="text/javascript">
				jQuery(document).ready(function() {
					createStoryJS({
						type:       'timeline',
						width:      '100%',
						height:     '100%',
						source:     '<?php print caNavUrl($this->request, '', 'Gallery', 'getSetInfoAsJSON', array('mode' => 'timeline', 'set_id' => $vn_timeline_set_id)); ?>',
						embed_id:   'timeline-embed'
					});
				});
			</script>
		</div>
	</div>
<?php
	}
?>
	
	<div class="row tanBg">
		<div class="col-md-12 col-lg-10 col-lg-offset-1">
			<H2>Explore by Narrative Thread</H2>
			<div class="row frontNarrativeThreads">
<?php
	$t_set = new ca_sets();
	if(is_array($va_narrative_threads) && sizeof($va_narrative_threads)){
		foreach($va_narrative_threads as $vn_item_id => $va_narrative_thread){
			# --- is there a set of featured items to pull from?
			$vs_image = "";
			$t_set->load(array("set_code" => str_replace(" ", "_", $va_narrative_thread["idno"])));
			if($t_set->get("set_id")){
				$va_set_reps = $t_set->getRepresentationTags("widepreview", array("checkAccess" => $va_access_values));
				shuffle($va_set_reps);
				$vs_image = $va_set_reps[0];
			}
			print "<div class='col-sm-3'>";
			print "<div class='frontNarrativeThreadContainer'><div>".caNavLink($this->request, $vs_image, "", "", "Explore", "narrativethreads", array("id" => $vn_item_id))."</div>".
						"<div class='frontNarrativeThreadDesc'><H2>".caNavLink($this->request, $va_narrative_thread["name_singular"], "", "", "Explore", "narrativethreads", array("id" => $vn_item_id))."</H2>".
						"</div></div>";
			print "</div>";
		}
	}
?>
				<div class='col-sm-12 frontNarrativeThreadsAllLink'><?php print caNavLink($this->request, "Explore All <i class='fa fa-arrow-right' aria-hidden='true'></i>", "btn-default btn-lg", "", "Explore", "narrativethreads"); ?></div>

			</div>
		</div>
	</div>
<?php	
	if($vs_partners_set_code = $this->config->get("front_page_partners_set_code")){
		$t_partners_set = new ca_sets();
		$t_partners_set->load(array('set_code' => $vs_partners_set_code));
		$vn_partners_set_id = $t_partners_set->get("set_id");
		
		# Enforce access control on set
		if((sizeof($va_access_values) == 0) || (sizeof($va_access_values) && in_array($t_partners_set->get("access"), $va_access_values))){
			$va_partner_ids = array_keys(is_array($va_tmp = $t_partners_set->getItemRowIDs(array('checkAccess' => $va_access_values, 'shuffle' => $vn_shuffle))) ? $va_tmp : array());
			$qr_partners = caMakeSearchResult('ca_entities', $va_partner_ids);
		}
	}
	if($qr_partners && $qr_partners->numHits()){
		$o_ent_context = new ResultContext($this->request, 'ca_entities', 'front');
		$o_ent_context->setAsLastFind();
		$o_ent_context->setResultList(array_keys($t_partners_set->getItemRowIDs()));
		$o_ent_context->saveContext();
?>
	<div class="row">
		<H2 class="text-center">Partners</H2>
		<div class="col-lg-12">
			<div class="jcarousel-wrapper">
				<div class="jcarousel">
					<ul>

<?php
			while($qr_partners->nextHit()){
				print "<li><div class='repositoryTile'>";
				$vs_image = $qr_partners->getWithTemplate("<unit relativeTo='ca_entities'>^ca_object_representations.media.iconlarge</unit>", array("checkAccess" => $va_access_values, "limit" => 1));
				if(!$vs_image){
					$vs_image = $qr_partners->getWithTemplate("<unit relativeTo='ca_objects' length='1'>^ca_object_representations.media.iconlarge</unit>", array("checkAccess" => $va_access_values, "limit" => 1));
				}
				if($vs_image){
					print "<div>".caDetailLink($this->request, $vs_image, '', 'ca_entities', $qr_partners->get("entity_id"))."</div>";
				}
				print "<div>".caDetailLink($this->request, $qr_partners->get('ca_entities.preferred_labels'), '', 'ca_entities', $qr_partners->get("entity_id"))."</div>";
				print "</div></li>";
			}
?>
					</ul>
				</div>
				<!-- Prev/next controls -->
				<a href="#" class="jcarousel-control-prev"><i class="fa fa-angle-left"></i></a>
				<a href="#" class="jcarousel-control-next"><i class="fa fa-angle-right"></i></a>
		
				<!-- Pagination -->
				<p class="jcarousel-pagination">
				<!-- Pagination items will be generated in here -->
				</p>			
			</div>	<!-- end jc wrapper -->
			<script type='text/javascript'>
				jQuery(document).ready(function() {
					/*
					Carousel initialization
					*/
					$('.jcarousel')
						.jcarousel({
							// Options go here
							wrap:'circular'
						});
		
					/*
					 Prev control initialization
					 */
					$('.jcarousel-control-prev')
						.on('jcarouselcontrol:active', function() {
							$(this).removeClass('inactive');
						})
						.on('jcarouselcontrol:inactive', function() {
							$(this).addClass('inactive');
						})
						.jcarouselControl({
							// Options go here
							target: '-=1'
						});
		
					/*
					 Next control initialization
					 */
					$('.jcarousel-control-next')
						.on('jcarouselcontrol:active', function() {
							$(this).removeClass('inactive');
						})
						.on('jcarouselcontrol:inactive', function() {
							$(this).addClass('inactive');
						})
						.jcarouselControl({
							// Options go here
							target: '+=1'
						});
		
					/*
					 Pagination initialization
					 */
					$('.jcarousel-pagination')
						.on('jcarouselpagination:active', 'a', function() {
							$(this).addClass('active');
						})
						.on('jcarouselpagination:inactive', 'a', function() {
							$(this).removeClass('active');
						})
						.jcarouselPagination({
							// Options go here
						});
				});
			</script>
		</div>
	</div>

<?php
	}
?>

<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.notificationMessage').delay(1000).fadeOut('slow');
	});
</script>