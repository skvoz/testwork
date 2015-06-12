<?php

date_default_timezone_set('America/Los_Angeles');


/**01/18/2013 01:02:03 to 2012-05-01 01:02:03
 * @param $date
 * @param $format
 * @return bool|string
 */
function formatter($date, $format) {
    return date($format, strtotime($date));
}
echo 'start date: 01/18/2013 01:02:03 <br/>';
echo 'date after formatting :';
echo formatter('01/18/2013 01:02:03', 'Y-m-d H:i:s');