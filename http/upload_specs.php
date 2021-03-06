<?php
/**
 * @file http/upload_specs.php
 * @brief Web interface for uploading ontologies to the HTML specification generator.
 * @version beta
 * @author David R Newman
 * @details Web interface for uploading ontologies to the HTML specification generator.  Restricted by an .htaccess with local password.
 */

/** @brief The page title to be displayed in an h1 tag and the title of the html header. */
$pagetitle="Ontology Uploader";
include('include.inc.php');
include('partials/header.inc.php');
include_once('connect/ontologies.inc.php');
require_once('functions/4store.inc.php');
/** @brief An array containing the options for which type of Ontology/Schema is being uploaded/cached. */
$types=array("OWL Ontology","RDFS Schema","Unsure");
foreach($_POST as $postkey => $postvar){
	$_POST[$postkey]= mysql_real_escape_string($postvar);
}
if (!$_POST['timeout'] || !is_int(intval($_POST['timeout'])) || intval($_POST['timeout'])<=0) $_POST['timeout']=30;
if ($_POST['addedit']||$_POST['cache']||$_POST['uploadcache']){
	if ($_POST['ontology']){
        	$tab10=array();
		$uquery="update ontologies set name='$_POST[name]', url='$_POST[url]', image='$_POST[image]', namespace='$_POST[namespace]', ontology_type='$_POST[ontology_type]', timeout=$_POST[timeout] where id='$_POST[ontology]'";
		$ures=mysql_query($uquery);
	}
	else{
		$iquery="insert into ontologies values('','$_POST[name]','$_POST[url]','$_POST[image]','$_POST[namespace]','$_POST[ontology_type]',$_POST[timeout])";
		$ires=mysql_query($iquery);
		$_POST['ontology']=mysql_insert_id();
	}
	if ($_POST['cache']||$_POST['uploadcache']){
		if (preg_match("/^[a-zA-Z]+[:\/\/]+[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+$/i",$_POST['url']) && preg_match("/[A-Za-z\-_]+/",$_POST['name'])){
	               if ($_POST['uploadcache']){
				$log="/tmp/".$_POST['name']."_retrieve_".time().".log";
				$qstr="op=retrieveOntology&amp;name=".$_POST['name']."&amp;url=".$_POST['url']."&amp;ontology=".$_POST['ontology']."&amp;log=".$log;
			}
			elseif ($_POST['cache']){
				$log="/tmp/".$_POST['name']."_cache_".time().".log";
				$qstr="op=cacheSpec&amp;name=".$_POST['name']."&amp;url=".$_POST['url']."&amp;ontology=".$_POST['ontology']."&amp;log=".$log;
			}
			echo '<iframe width="100%" src="tailprocess.php?'.$qstr.'#BOTTOM"></iframe>';
		}
		else echo "The URL must be valid and the name should not contain anything other than letters, underscores and hyphens.<br/><br/>";
	}
}
	
/** @brief A string containg the SQL query to retrieve the details about all registered ontologies in the HTML Document Specification generator system. */
$onto_query="select * from ontologies order by name, namespace";
/** @brief The result from the $onto_query SQL query to retrieve details about all registered ontologies in the HTML Document Specification generator system. */ 
$onto_res=mysql_query($onto_query);
for ($i=0; $i<mysql_num_rows($onto_res); $i++){
	$ontologies[]=mysql_fetch_assoc($onto)res);
	if ($_POST['ontology']==$ontologies[$i]['id']){
		$ontology=$ontologies[$i]['id'];	
		$name=$ontologies[$i]['name'];
		$url=$ontologies[$i]['url'];
		$image=$ontologies[$i]['image'];
		$namespace=$ontologies[$i]['namespace'];
		$ontology_type=$ontologies[$i]['ontology_type'];
		$timeout=$ontologies[$i]['timeout'];
		$reasonedont="file:///var/data/ontologies/reasoned/".$ontology."_".$name."_reasoned.owl";
	}
}
?>

<form name="ontology_uploader" method="post" action="">
<?php 
if ($_GET['get_queries']){
	$filteront=$namespace;
	if ($ontology_type=="RDFS Schema") include_once('specifications/rdfs_queries.inc.php');
	elseif ($ontology_type=="OWL Ontology") include_once('specifications/owl_queries.inc.php');
	elseif ($ontology_type=="Unsure") include_once('specifications/queries.inc.php');
	echo "<table>";
	foreach ($queries as $k => $v){
		echo "<tr><th style=\"vertical-align: top;\">$k</th><td>".htmlentities($v)."<br/><br/></td></tr>\n";
	}
} ?>
	
  <table>
    <tr>
      <td><b>Ontology:</b></td>
      <td>
        <select name="ontology">
          <option value="">Select...</option>
<?php
for ($i=0; $i<sizeof($ontologies); $i++){
	echo "<option ";
	if ($_POST['ontology']==$ontologies[$i]['id']) echo 'selected="selected" ';
	echo 'value="'.$ontologies[$i]['id'].'">'.$ontologies[$i]['name'].' ('.$ontologies[$i]['namespace'].')</option>'."\n";
}
?>
        </select>
        &nbsp;&nbsp;<input type="submit" name="get" value="View"/>
      </td>
    </tr>
    <tr><td><b>Name:</b></td><td><input type="text" name="name" value="<?=$name ?>"/></td>
    <tr><td><b>URL:</b></td><td><input type="text" name="url" size="50" value="<?=$url ?>"/></td>
    <tr><td><b>Namespace:</b></td><td><input type="text" name="namespace" size="50" value="<?=$namespace ?>"/></td>
    <tr><td><b>Query Timeout:</b></td><td><input type="text" name="timeout" size="2" maxlength="2" value="<?=$timeout ?>"/> secs</td>
    <tr>
      <td><b>Type:</b></td>
      <td>
        <select name="ontology_type">
<?php
foreach ($types as $atype){
	echo "          <option ";
	if ($atype==$ontology_type) echo 'selected="selected" ';
	echo "value=\"$atype\">$atype</option>\n";
}
?>
        </select>
      </td>
    </tr>
    <tr><td><b>Image:</b></td><td><input type="text" name="image" size="50" value="<?=$image ?>"/></td>
    <tr><td colspan="2" style="text-align: center;"><input type="submit" name="addedit" value="Add/Edit"/>&nbsp;&nbsp;<input type="submit" name="uploadcache" value="Upload &amp; Cache"/>&nbsp;&nbsp;<input type="submit" name="cache" value="Cache"/>&nbsp;&nbsp;<a href="generic/spec?ontology=<?= $_POST['ontology'] ?>">View Ontology Spec</a></td></tr>
  </table>
</form>
<?php include('partials/footer.inc.php'); ?>
