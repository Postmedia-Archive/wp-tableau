<?php
/*
Plugin Name: Tableau
Plugin URI: http://github.com/postmedia/wp-tableau
Description: Shortcode for displaying data from Tableau Public
Version: 0.1
Author: Postmedia Network Inc.
License: MIT
*/


// register Tableau shortcode
function pd_tableau_shortcode($attr){
  
  extract( shortcode_atts( array(
      'width' => '800',
      'height' => '1000',
      'id' => 'shared/9G78NK9K4',
      'tabs' => 'no'
    ), $attr ) );
  
  // when saved as shared, use the parameter 'path' otherwise use 'name'  
  $identifier = strpos($id, 'shared/') === false ? 'name' : 'path';

  return <<<TBJS
  <script type="text/javascript" src="http://public.tableausoftware.com/javascripts/api/viz_v1.js"></script>
  <div class="tableauPlaceholder" style="width:{$width}px; height:{$height}px;">
    <object class="tableauViz" width="{$width}" height="{$height}" style="display:none;">
      <param name="host_url" value="http://public.tableausoftware.com/" />
      <param name="{$identifier}" value="{$id}" />
      <param name="tabs" value="{$tabs}" />
      <param name="toolbar" value="yes" />
      <param name="animate_transition" value="yes" />
      <param name="display_spinner" value="yes" />
      <param name="display_overlay" value="yes" />
      <param name="display_count" value="yes" />
    </object>
  </div>
  <div style="width:{$width}px;height:22px;padding:0px 10px 0px 0px;color:black;font:normal 8pt verdana,helvetica,arial,sans-serif;">
    <div style="float:right; padding-right:8px;">
      <a href="http://www.tableausoftware.com/public?ref=http://public.tableausoftware.com/views/{$id}" target="_blank">Powered by Tableau</a>
    </div>
  </div>
TBJS;

}
add_shortcode( 'tableau', 'pd_tableau_shortcode' );
?>