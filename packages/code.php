<?php
exec('node index.js "<mjml><mj-body><mj-container><mj-section><mj-column><mj-text>Hello World</mj-text></mj-column></mj-section></mj-container></mj-body></mjml>"', $res);
$r=json_decode($res[0]);
print_r($r);
?>
