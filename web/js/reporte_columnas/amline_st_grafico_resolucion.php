<?php require_once(dirname(__FILE__).'/../../../config/variablesGenerales.php'); ?>
<?php echo "<?xml version='1.0' encoding='UTF-8'?>
<settings> 
<!-- fondo degradado de la grafica -->
  <background> 
    <color>#FFFFFF</color>
	<alpha>100</alpha>
	<border_color>#FFFFFF</border_color>
	<border_alpha>100</border_alpha>
  </background>
  <!-- margenes de la grafica -->
  <plot_area> 
    <margins> 
      <left>70</left>
      <top>60</top>
      <right>50</right> 
      <bottom>60</bottom> 
    </margins>
  </plot_area>
  <!-- titulo de la grafica -->
  <labels> 
    <label lid='0'>
      <x>5</x>
      <y>20</y>
      <width>700</width> 
      <align>center</align>
      <text_size>13</text_size>
      <text> 
        <![CDATA[<b>Tendencia Resolución (R) / día</b>]]>
      </text> 
    </label>
	<label lid='2'>
      <x>92%</x> 
      <y>325</y>
      <width>40</width>
      <align>right</align> 
      <text>
        <![CDATA[<b>Días</b>]]>
      </text> 
    </label>
	<label lid='1'>
      <x>15</x> 
      <y>55%</y>
      <rotate>true</rotate> 
      <width>100</width>
      <align>left</align>
      <text>
        <![CDATA[<b>Resolución (R)</b>]]>
      </text> 
    </label>
  </labels>
  <!--Me permite poner texto adicconal sobre la grafica -->
	<guides>	        
	 <max_min>true</max_min>
	</guides> 
  <!-- rotar eje x -->
  <!-- cantidad lineas vertical -->
  <grid> 
    <x>
      <approx_count>10</approx_count>
    </x>
  </grid>
  <export_as_image>
    <file>".$urlWeb."flash/amline/export.php</file>     
    <color>#CC0000</color>                      
    <alpha>50</alpha>                           
  </export_as_image>
</settings>"; ?>

<!-- rotar eje x -->
<!--  <values> 
    <x>
      <rotate>45</rotate>
    </x>
  </values>-->
