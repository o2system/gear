<style type="text/css">
    <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__.'/assets/css/debugger.min.css')) ?>
</style>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th></th>
            <th>File</th>
            <th>Expression</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ( $trace as $chronology ): ?>
            <tr>
                <td width="5">
                    <?php if ( strpos( $chronology->call, 'start' ) !== false ): ?>
                        <span class="label label-success">start</span>
                    <?php elseif ( strpos( $chronology->call, 'line' ) !== false ): ?>
                        <span class="label label-info">line</span>
                    <?php elseif ( strpos( $chronology->call, 'marker' ) !== false ): ?>
                        <span class="label label-default">marker</span>
                    <?php elseif ( strpos( $chronology->call, 'stop' ) !== false ): ?>
                        <span class="label label-danger">stop</span>
                    <?php endif; ?>
                </td>
                <td width="5">
                    <i class="text-muted"><?php echo $chronology->file . ':' . $chronology->line; ?></i>
                </td>
                <td>
                    <pre>
                        <code>
                          <?php echo( empty( $chronology->expression ) ? '' : $chronology->expression ); ?>
                        </code>
                    </pre>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>