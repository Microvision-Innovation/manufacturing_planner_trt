<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>

<!--<select id="box1View" name="results[]" class="form-control" size="10" required="required" multiple="multiple">-->
<!--    --><?php //foreach($recipients as $r): ?>
<!--    <option value="--><?php //echo $r->id; ?><!--">--><?php //echo $r->display_name." (".$r->email.")"; ?><!--</option>-->
<!--    --><?php //endforeach; ?>
<!--</select>-->
<div class="vscrollmenu">
<table   cellspacing="1" cellpadding="3" width="100%" border="1" class="table-fixed" align="center"  bordercolor="#dcdedb" >
    <thead>
    <tr bgcolor="black">
        <th width="1%" class="text-light">&nbsp;</th>
        <th class="text-light">Full Names</th>
        <th class="text-light">User Level</th>
        <th class="text-light">County</th>
        <th class="text-light">Email</th>
    </tr>
    </thead>
    <tbody>
    <?php $n=0; foreach($recipients as $r): $n++; ?>
    <tr>
        <td><input type="checkbox" name="recipients[]" id="recipients" checked value="<?php echo $r->email; ?>"></td>
        <td><?php echo ucwords(strtolower($r->display_name)); ?></td>
        <td><?php echo ucwords($r->role_name); ?></td>
        <td><?php echo ucwords($r->county); ?></td>
        <td><a href="mailto:<?php echo $r->email; ?>"><?php echo $r->email; ?></a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<span class="h6 pull-right" align="right"><?php echo $recipient_count->total; ?> Recipients </span>