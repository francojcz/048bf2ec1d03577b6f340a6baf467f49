<?php require_once(dirname(__FILE__).'/../../../config/variablesGenerales.php'); ?>
<?php echo "<?xml version='1.0' encoding='UTF-8'?>
<settings> 

  <pie>
	<radius>30%</radius>
    <inner_radius>50</inner_radius>
    <height>20</height>
	<angle>30</angle> 
    <hover_brightness>-10</hover_brightness>
    <gradient>radial</gradient>
    <gradient_ratio>0,0,0,-50,0,0,0,-50</gradient_ratio> 
  </pie>

  <animation>
    <start_time>2</start_time> 
    <start_effect>strong</start_effect> 
    <start_alpha>0</start_alpha> 
    <sequenced>true</sequenced>
    <pull_out_on_click>true</pull_out_on_click> 
    <pull_out_time>1.5</pull_out_time>
    <pull_out_effect>Bounce</pull_out_effect> 
  </animation>
  
  <data_labels>
    <show>
       <![CDATA[{title}: {percents}%]]> 
    </show>
  </data_labels>

  <background> 
    <color>#FFFFFF</color>
	<alpha>100</alpha>
	<border_color>#FFFFFF</border_color>
	<border_alpha>100</border_alpha>
  </background>
  
  <balloon> 
    <alpha>80</alpha>
    <show>
       <![CDATA[{title}: {value} Hrs. ({percents}%) <br>{description}]]>
    </show>
    <max_width>300</max_width>
    <corner_radius>5</corner_radius>
    <border_width>3</border_width>
    <border_alpha>50</border_alpha> 
    <border_color>#000000</border_color> 
  </balloon>
  
  <legend>
    <enabled>true</enabled> 
    <align>center</align> 
    <values> 
      <text><![CDATA[]]></text>
    </values>
	<border_color>#FFFFFF</border_color>
    <border_alpha>15</border_alpha>    
  </legend>
  
  <export_as_image>
    <file>".$urlWeb."flash/amline/export.php</file>     
    <color>#CC0000</color>                      
    <alpha>50</alpha>                           
  </export_as_image>
  
  <labels>
    <label lid='0'>
      <x>0</x>
      <y>21</y> 
      <rotate>false</rotate> 
      <align>center</align>
      <text_size>13</text_size> 
      <text>
        <![CDATA[<b>Consolidado de tiempos para cálculo OEE / semana</b>]]>
      </text> 
    </label>
  </labels>
</settings>"; ?>
