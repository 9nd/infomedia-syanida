<?php
$hp_email_total=count($hp_email->result_array());
$hp_only_total=count($hp_only->result_array());
?>
<tr>
    <td><?php echo number_format($hp_email_total); ?></td>
    <td><?php echo number_format($hp_only_total); ?></td>
    <td><?php echo number_format($hp_email_total+$hp_only_total); ?></td>
</tr>