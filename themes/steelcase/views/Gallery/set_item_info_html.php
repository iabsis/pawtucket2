<?php print "(".$this->getVar("set_item_num")."/".$this->getVar("set_num_items").")<br/>"; ?>
<H4>{{{<i>^ca_objects.preferred_labels.name</i><ifdef code="ca_objects.creation_date">, ^ca_objects.creation_date</ifdef>}}}</H4>
{{{<ifcount code='ca_entities' restrictToRelationshipTypes='creator' min='1'><H5><unit relativeTo='ca_entities' restrictToRelationshipTypes='creator' delimiter=', '><l>^ca_entities.preferred_labels.name<ifdef code="ca_entities.dob_dod|ca_entities.nationality"> (</ifdef><ifdef code="ca_entities.nationality">^ca_entities.nationality</ifdef><ifdef code="ca_entities.dob_dod,ca_entities.nationality">, </ifdef>^ca_entities.dob_dod<ifdef code="ca_entities.ca_entities.dob_dod|ca_entities.nationality">)</ifdef></l></unit></H5></ifcount>}}}

<?php print caDetailLink($this->request, _t("VIEW RECORD"), '', 'ca_objects',  $this->getVar("object_id")); ?>