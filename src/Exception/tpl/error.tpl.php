<?php
/* -------------------------------------------------------------------------------------------------
 * File:    ControlAltKaboom\Exception - tpl/error.tpl.php
 * Version: 1.0
 * Desc:    Custom Error/Exception Output Template (Complete)

 ToDo:
  -> try to allow for AppBase functions if available, maybe check/sudo them in the bootstrap ?
  -> at least clean up and format the var and array dumps better

 * -------------------------------------------------------------------------------------------------
*/


include ("error-header.tpl.php");

print <<<END
<div class="error_dump">
<table>
<tr>
  <th colspan="2">Exception: {$GLOBALS['CUF']("get_class", $this)}</th>
</tr>
<tr>
  <td colspan="2" style="padding: 15px 7px">{$this->getMessage()}</td>
</tr>
END;

if (is_array($this->getParams())):
print <<<END
<tr>
  <td class="bold" colspan="2">Error params:</td>
</tr>
END;


foreach ($this->getParams() as $param_name => $param_value):

print <<<END
<tr>
  <td valign='top'>{$GLOBALS['CUF']("ucfirst", $param_name)} :</td>
  <td class="monospace">
END;

if(strtolower($param_name) == "sql"):
  print "<pre>" .print_r($param_value,true) . "</pre>";
  //control::dump($param_value); 
  //print "its an sql param";
  
elseif (is_scalar($param_value)):
  print "<pre>" .var_dump($param_value) . "</pre>";

  //echo clean($param_value);
  //print "its scalar";

elseif (is_null($param_value)):
  print "Param is NULL";
  
else:
  echo var_dump($param_value);

endif;

print <<<END
  </td>
</tr>
END;

endforeach;

endif;

print <<<END
<tr>
  <td class="bold" colspan="2">Backtrace:</td>
</tr>
<tr>
  <td colspan="2" class="monospace">{$GLOBALS['CUF']("nl2br", $this->getTraceAsString())}</td>
</tr>
<tr>
  <td class="bold" colspan="2">Autoglobal varibles:</td>
</tr>
<tr>
  <td style="vertical-align: top">\$_GET:</td>
  <td class="monospace">

END;

if (isset($_GET) && is_array($_GET) && count($_GET)):
  //echo nl2br(clean_var_info($_GET));
  echo nl2br(var_dump($_GET));

endif;

print <<<END
  </td>
</tr>
<tr>
<td style="vertical-align: top">\$_POST:</td>
  <td class="monospace">

END;

if (isset($_POST) && is_array($_POST) && count($_POST)):
  //echo nl2br(clean_var_info($_POST));
  echo nl2br(var_dump($_GET));

endif;

print <<<END
  </td>
</tr>
<tr>
  <td style="vertical-align: top">\$_COOKIE:</td>
  <td class="monospace">

END;

if (isset($_COOKIE) && is_array($_COOKIE) && count($_COOKIE)):
  //echo nl2br(clean_var_info($_COOKIE));
  echo nl2br(var_dump($_GET));

endif;

print <<<END
  </td>
</tr>
<tr>
  <td style="vertical-align: top">\$_SESSION:</td>
  <td class="monospace">

END;

if (isset($_SESSION) && is_array($_SESSION) && count($_SESSION)):
//  echo nl2br(clean_var_info($_SESSION));
  echo nl2br(var_dump($_GET));
endif;

print <<<END
  </td>
</tr>
</table>
</div>

END;


include ("error-footer.tpl.php");


