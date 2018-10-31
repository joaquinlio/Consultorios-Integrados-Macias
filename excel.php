<?
require "config/config.php";
header("Pragma: public");
header("Expires: 0");
$filename = "prueba.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
?>
<table width="50%" border="1" cellpadding="10" cellspacing="0" bordercolor="#666666" id="Exportar_a_Excel" style="border-collapse:collapse;">
   <tr>
      <td>Celda1</td>
      <td>Celda2</td>
      <td>Celda3</td>
      <td>Celda4</td>
      <td>Celda5</td>
   </tr>
   <tr>
      <td>Celda6</td>
      <td>Celda7</td>
      <td>Celda8</td>
      <td>Celda9</td>
      <td>Celda10</td>
   </tr>
</table>