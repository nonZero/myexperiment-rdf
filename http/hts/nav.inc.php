<?php
/**
 * @file http/hts/nav.inc.php
 * @brief Navigation functions for How to SPARQL guide.
 * @version beta
 * @author David R Newman
 * @details Functions to generate navigation bar dependent on which page of the How to SPARQL guide is being currently being displayed.
 */

/**
 * @brief Prints the navigation bar for a specified How to SPARQL guide page.
 *
 * @param $name
 * A string containing the name for the navigation bar form.
 *
 * @param $pageno
 * An integer containing the number of the current How To SPARQL guide page.
 *
 * @param $pages
 * An array containing the names of all pages in the How to SPARQL guides in order.
 * 
 */
function printHowToSPARQLNavigationForm($name, $pageno, $pages) {
	echo "<form name=\"$name\" action=\"#\" method=\"get\" />\n";
        echo "  <table style=\"margin: auto;\"><tr>\n";
	if ($pageno==1) {
		echo "    <td class=\"nofirstpage\"></td>\n    <td class=\"noprevpage\" width=\"16px\"></td>\n";
	}
	else {
		echo "    <td class=\"firstpage\"><a href=\"?page=".$pages[1]."\">&nbsp;&nbsp;&nbsp;</a></td>\n    <td class=\"prevpage\" width=\"16px\"><a href=\"?page=".$pages[$pageno-1]."\">&nbsp;&nbsp;&nbsp;</a></td>\n";
	}
	echo "    <td>\n      <select name=\"page\" onChange=\"document.$name.submit();\">\n";
	foreach ($pages as $pno => $p) {
		echo "        <option ";
		if ($pno==$pageno) echo "selected=\"selected\" ";
		echo "value=\"$p\">$pno. $p</option>\n";
	}
	echo "      </select>\n&nbsp;<input type=\"submit\" name=\"submit_button\" value=\"Go\"/>\n    </td>\n";
	if ($pageno==sizeof($pages)) {
                echo "    <td class=\"nonextpage\" width=\"16px\"></td>\n    <td class=\"nolastpage\"></td>\n";
        }
        else {
		$next=$pageno+1;
                echo "    <td class=\"nextpage\" width=\"16px\"><a href=\"?page=".$pages[$pageno+1]."\">&nbsp;&nbsp;&nbsp;</a></td>\n    <td class=\"lastpage\"><a href=\"?page=".$pages[sizeof($pages)]."\">&nbsp;&nbsp;&nbsp;</a></td>\n";
        }
	echo "    <td>&nbsp;&nbsp;<a href=\"?\">Back to Contents Page</a></td>\n";
	echo "  </tr></table>\n";
	echo "</form>";	 
}
