<form enctype="multipart/form-data" method="post" action="<?php echo $sFormAction;  ?>">
  File:  <input type="file" name="image"><br><br>
  File2: <input type="file" name="image_user"><br><br>
  Text1: <input value="aaaaaa" type="text" name="heading[heading_1]"><br><br>
  Text2: <input value="bbbbbb" type="text" name="heading[heading_2]"><br><br>
  Text3: <input value="cccccc" type="text" name="heading[heading_3]"><br><br>
  Text4: <input value="dddddd" type="text" name="heading[heading_4]"><br><br>
  Text Area <textarea name="heading[text_area]"></textarea><br>
  Dpi X  <input id="dpi_x" readonly type="text" name="dpi_x"><br><br>
  Dpi Y  <input id="dpi_y" readonly type="text" name="dpi_y"><br><br>
  <input type="submit" value="Submit">
  
</form>
<!--<div style="height: 1in;left: -100%;position: absolute;top: -100%;width: 1in;" id="testdiv"></div>
<div id="dementionsDiv"></div>

<br>size in inches = size in pixels / dots per inch
<script>
window.onload = function ()
{
var dpi_x = document.getElementById('testdiv').offsetWidth;
var dpi_y = document.getElementById('testdiv').offsetHeight;
var width_in = screen.width / dpi_x;
var height_in = screen.height / dpi_y;
var diagonal_in = Math.round(10 * Math.sqrt(width_in * width_in + height_in * height_in)) / 10;

var dimentions = 'dpi_x = '+dpi_x+'<br>  dpi_y = '+dpi_y+'  '+' <br> width_in = '+width_in+' <br> height_in = '+height_in+' <br> diagonal_in = '+diagonal_in ;
document.getElementById('dementionsDiv').innerHTML  = dimentions;

document.getElementById('dpi_x').value  = dpi_x;
document.getElementById('dpi_y').value  = dpi_y;
}

</script>-->