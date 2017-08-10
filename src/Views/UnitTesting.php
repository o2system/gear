<style type="text/css">
    <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__.'/assets/css/unit-testing.min.css')) ?>
</style>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Label</th>
            <th colspan="2">Result</th>
            <th colspan="2">Expected</th>
            <th>Status</th>
            <th>Trace</th>
            <th>Notes</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach( $reports as $report ): ?>
            <tr class="<?php echo ( $report->status === 'passed' ? 'success' : 'danger' ); ?>">
                <td width="20">
                    <strong><?php echo $report->label; ?></strong>
                </td>
                <td width="20">
                    <?php if( is_array( $report->result ) || is_object( $report->result ) ): ?>
                        <pre>
                            <?php echo print_r( $report->result, true ); ?>
                        </pre>
                    <?php else: ?>
                        <?php echo $report->result; ?>
                    <?php endif; ?>
                </td>
                <td width="5">
                    <span class="label label-info"><?php echo $report->datatype->result; ?></span>
                </td>
                <td width="20">
                    <?php if( is_array( $report->expected ) || is_object( $report->expected ) ): ?>
                        <pre>
                            <?php echo print_r( $report->expected, true ); ?>
                        </pre>
                    <?php else: ?>
                        <?php echo $report->expected; ?>
                    <?php endif; ?>
                </td>
                <td width="5">
                    <span class="label label-info"><?php echo $report->datatype->expected; ?></span>
                </td>
                <td width="5">
                    <?php if( $report->status === 'passed' ): ?>
                        <span class="label label-success">Passed</span>
                    <?php else: ?>
                        <span class="label label-danger">Failed</span>
                    <?php endif; ?>
                </td>
                <td width="10">
                    <i class="text-muted"><?php echo $report->trace->file; ?>:<?php echo $report->trace->line; ?></i>
                </td>
                <td width="20">
                    <p><?php echo $report->notes; ?></p>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>