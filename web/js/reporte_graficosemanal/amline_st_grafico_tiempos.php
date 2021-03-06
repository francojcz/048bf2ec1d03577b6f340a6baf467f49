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
      <width>520</width> 
      <align>center</align>
      <text_size>13</text_size>
      <text> 
        <![CDATA[<b>Tendencia tiempos para cálculo OEE / Semana</b>]]>
      </text> 
    </label>
    <label lid='2'>
      <x>88%</x> 
      <y>315</y>
      <width>50</width>
      <align>right</align> 
      <text>
        <![CDATA[<b>Sem.</b>]]>
      </text> 
    </label>
	<label lid='1'>
      <x>20</x> 
      <y>50%</y>
      <rotate>true</rotate> 
      <width>100</width>
      <align>left</align>
      <text>
        <![CDATA[<b>Hrs</b>]]>
      </text> 
    </label>
  </labels>
  <!--Me permite poner texto adicconal sobre la grafica -->
	<guides>	        
	 <max_min>true</max_min>
	</guides> 
<!-- rotar eje x -->
  <values> 
    <x>
      <rotate>45</rotate>
    </x>
  </values>
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
