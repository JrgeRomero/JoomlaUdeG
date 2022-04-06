<?php
/**
 * @package   RokCheck Helper
 * @author    RocketTheme - Mark Taylor (a.k.a MrT) http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2019 RocketTheme, LLC
 * @license   GNU/GPLv2 and later
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 */
class ModRokcheckHelper
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getResults($params)
    {
      
        // Get a db connection.
        $db = JFactory::getDbo();

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from the extensions table where the are "rt_" or "g5_" templates.
        // Order it by the ordering field Ascending.
        $query->select($db->quoteName(array('name', 'manifest_cache')));
        $query->from($db->quoteName('#__extensions'));
        $query->where($db->quoteName('type') . ' = ' . $db->quote('template') . " AND (" . $db->quoteName('name') . " LIKE " . $db->quote('rt_%') . " OR " . $db->quoteName('name') . " LIKE " . $db->quote('g5_%') . ") AND " . $db->quoteName('name') . " <> " . $db->quote('g5_helium') . " AND " . $db->quoteName('name') . " <> " . $db->quote('g5_hydrogen') . "");
        $query->order('ordering ASC');

        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $db->execute();
        // get the number of rows found
        $num_rows = $db->getNumRows();
        // If there are no RocketTheme templates then do no more.
        if ($num_rows == 0) {
          return "You have no RocketTheme templates.";
        }
      
        // Caching
        $cache = JFactory::getCache('mod_rokcheck', ''); 
        // Force cache enable. If caching is disabled though, that would be why your data isn’t actually writing to cache. If you need it to persist regardless of global cache setting.
        $cache->setCaching(true); 
        $cache->setLifeTime(1440); // 1440 = 60minutes x 24 hours i.e. only one check per day
        $cacheKey = "release_data";
        // note the assignment in this test to get releases data from cache and to check if cache is present
        if (!($releases = $cache->get($cacheKey, ''))){
          // CACHE IS NOT PRESENT - so get RocketTheme product updates
          
          // get html from rocketTheme products updates.
          // Retrieve the DOM from a given URL
          $html = file_get_html('https://rockettheme.com/product-updates');

          // process updates table to construct latest version template array
          $releases = [];
          foreach($html->find('.updates-table tbody tr') as $tabrow) {
            // Only interested in Joomla template releases
            $isJoomla = $tabrow->find('td:nth-child(4) > span.joomla',0) <> null;
            $isTemplate =  $tabrow->find('td:nth-child(5) > span.template',0) <> null;
            // is this a Joomla Template?          
            if ($isJoomla && $isTemplate) {
              $item['release'] = $tabrow->find('td:nth-child(1) > span',0)->plaintext;
              $item['product'] = $tabrow->find('td:nth-child(2) > a',0)->plaintext;
              $item['version'] = $tabrow->find('td:nth-child(3) > em',0)->plaintext;
              $item['platform'] = 'joomla';
              $item['type'] = $tabrow->find('td:nth-child(5) > span.template',0)->plaintext;
              $item['summary'] = $tabrow->find('td:nth-child(6) > em.summary',0)->plaintext;
              $item['date'] = $tabrow->find('td:nth-child(7) > em.date',0)->plaintext;
              $releases[] = $item;
            }
          }
          // Testing only dump of releases
          //print_r($releases);

          // clear and unset to stop memory leaks
          $html->clear();
          unset($html);
          
          
          // store cached releases
          $cache->store($releases, $cacheKey);
        } else {
          // CACHE IS PRESENT
        }
      
        
        // Start building the assembly table output
        $assembly = "<br/><br/><table class='table table-striped'>";


        // Load the results as a list of stdClass objects.
        $results = $db->loadObjectList();
      
      
        // loop though each result as a row
        foreach ($results as $row) {
          
          // decode the manifest cache JSON object
          $manifest = json_decode($row->manifest_cache);
          // Store the template name
          $templatename = ucfirst(substr($row->name,3));
          $templatename = str_replace("_responsive", "", $templatename);
          // Store the templates version number
          $versionDB = $manifest->version;
          // Construct Formatted version number e.g. 1.1.1 should be 1.01.01 for comparison purposes
          $majorVersionDB = "1";
          $minorVersionDB = "00";
          $subVersionDB = "00";
          
          $splitVersionDB = explode(".", str_replace("-DEV", "", $versionDB));
          if (count($splitVersionDB) == 3) {
            $majorVersionDB = sprintf('%01d',$splitVersionDB[0]);
            $minorVersionDB = sprintf('%02d',$splitVersionDB[1]);
            $subVersionDB = sprintf('%02d',$splitVersionDB[2]);            
          }
          elseif (count($splitVersionDB) == 2) {
            $majorVersionDB = sprintf('%01d',$splitVersionDB[0]);
            $minorVersionDB = sprintf('%02d',$splitVersionDB[1]);
          }
          elseif (count($splitVersionDB) == 1) {
            $majorVersionDB = sprintf('%01d',$splitVersionDB[0]);
          }
          // Store the formatted Database version
          $versionFormattedDB = $majorVersionDB . "." . $minorVersionDB . "." . $subVersionDB ;
          
          
          // Initialise the out of date (OOD) string
          $ood = " ";
          
          
          // Try to find the templates latest release
          foreach ($releases as $entry ) {
            
            // does the template match, and is joomla, and is correct version, and there is a later release?
            if ($entry['product'] == $templatename 
                && $entry['platform'] == "joomla"
                && substr($entry['version'],0,1) == substr($versionDB,0,1)) {
              // sdsdf
              $majorVersionLU = "1";
              $minorVersionLU = "00";
              $subVersionLU = "00";
              // Format the Lookup Version
              $splitVersionLU = explode(".",$entry['version']);
              if (count($splitVersionLU) == 3) {
                $majorVersionLU = sprintf('%01d',$splitVersionLU[0]);
                $minorVersionLU = sprintf('%02d',$splitVersionLU[1]);
                $subVersionLU = sprintf('%02d',$splitVersionLU[2]);            
              }
              elseif (count($splitVersionLU) == 2) {
                $majorVersionLU = sprintf('%01d',$splitVersionLU[0]);
                $minorVersionLU = sprintf('%02d',$splitVersionLU[1]);
              }
              elseif (count($splitVersionLU) == 1) {
                $majorVersionLU = sprintf('%01d',$splitVersionLU[0]);
              }
              $versionFormattedLU = $majorVersionLU . "." . $minorVersionLU . "." . $subVersionLU;
              
              // Is this a later release?
              if  ($versionFormattedLU > $versionFormattedDB) {
                // There's a later release than the one installed so the template is out of date
                $ood = "Latest update is <span class='label label-success'>v" . $entry['version'] . "</span> (" . $entry['summary'] . ") " . $entry['date'] ;
                // DEBUGGING Only - $ood .= " DB=".$versionFormattedDB." LU=".$versionFormattedLU;
                // no need to look any further since the product update release are always latest to oldest order
                break;
              }
            }
            
            // next release line
          }
          
          
          // is the template out of date?
          if ($ood <> " ") {
            $name = "<td style='width: 20px; text-align: center;'><span class='icon-unpublish'></span></td><td style='width: 40px; text-align: right;'><span class='label label-warning'>v" . $versionDB . "</span></td><td style='width: 50px;'> <a href='https://rockettheme.com/joomla/templates/" . strtolower($templatename) . "' target='_blank'>" . $templatename . "</a></td>";
          } else {
            $name = "<td style='width: 20px; text-align: center;'><span class='icon-ok'></span></td><td style='width: 40px; text-align: right;'><span class='label label-success'>v" . $versionDB . "</span></td><td style='width: 50px;'> <a href='https://rockettheme.com/joomla/templates/" . strtolower($templatename) . "' target='_blank'>" . $templatename . "</a></td>";
          }
          // build more of assmebly for this specific template
          $assembly.= "<tr>" . $name . "<td>" .$ood . "</td></tr>" ;
          
          
          // next row result
        }
      
        // complete table
        $assembly .= "</table>";   
      
        // how many templates installed in writing...
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $plural = "";
        if ($num_rows <> 1) {$plural = "s";}
      
        // Final answer
        $finalanswer = 'You have ' . $f->format($num_rows) . " RocketTheme template" . $plural . " installed." . $assembly;
      
        // Return result
        return $finalanswer ;
    }
}