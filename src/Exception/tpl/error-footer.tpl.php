<?php
/* -------------------------------------------------------------------------------------------------
 * File:    ControlAltKaboom\Exception - tpl/error-footer.tpl.php
 * Version: 1.0
 * Desc:    Custom Error/Exception Output Template (Footer)
 * -------------------------------------------------------------------------------------------------
*/


$date = new DateTime();
$time = microtime();


print <<<END
  </section>

  <section id="error-foot">
  <footer>
    <div class="error-foot">
      Auto Generated with Custom Exceptions: {$date->format(DATETIME_STRFULL)} [{$time}]
    </div>
  </footer>
  </section>
</body>
</html>
END;

