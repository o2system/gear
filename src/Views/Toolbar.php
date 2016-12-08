<style type="text/css">
    <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__.'/assets/css/toolbar.css')) ?>
</style>

<script type="text/javascript">
    <?= file_get_contents( __DIR__ . '/assets/js/toolbar.js' ) ?>
</script>

<div id="gear-toolbar">
    <div class="toolbar">
        <h1><a href="#" onclick="gearToolbar.toggleToolbar();">Debug Bar</a></h1>

        <span>Duration: <?= $totalExecution->getDuration( 1 ) ?></span>
        <span>Memory Usage: <?= $totalExecution->getMemory() ?></span>
        <span>Memory Peak Usage: <?= $totalExecution->getPeakMemory() ?></span>
        <span class="gear-toolbar-label"><a href="javascript: void(0)"
                                            data-tab="gear-toolbar-timeline">Metrics</a></span>
        <span class="gear-toolbar-label"><a href="javascript: void(0)" data-tab="gear-toolbar-files">Files</a></span>
        <span class="gear-toolbar-label"><a href="javascript: void(0)" data-tab="gear-toolbar-vars">Vars</a></span>
        <span class="gear-toolbar-label"><a href="javascript: void(0)" data-tab="gear-toolbar-logs">Logs</a></span>
    </div>

    <!-- Timeline -->
    <div id="gear-toolbar-timeline" class="tab">
        <table class="timeline">
            <thead>
            <tr>
                <th style="width: 30%">EVENT</th>
                <th style="width: 10%;">DURATION</th>
                <?php for ( $i = 0; $i < $segmentCount; $i++ ) : ?>
                    <th><?= $i * $segmentDuration ?> ms</th>
                <?php endfor; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ( $metrics as $metric ): ?>
                <tr>
                    <td><?= $metric->getMarker(); ?></td>
                    <td style="text-align: right"><?= $metric->getDuration( 1 ); ?></td>
                    <td colspan="7" style="overflow: hidden">
                        <span class="timer" style="left: <?= $metric->offset; ?>%; width: <?= $metric->length; ?>%;"
                              title="<?= number_format( $metric->length, 2 ); ?>%"></span>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Files -->
    <div id="gear-toolbar-files" class="tab">
        <h2>Files <span>(<?= count( $files ); ?>)</span></h2>

        <table>
            <tbody>
            <?php foreach ( $files as $file ): ?>
                <tr>
                    <td style="width: 20em;"><?= pathinfo( $file, PATHINFO_FILENAME ); ?></td>
                    <td><?= $file; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!-- Vars -->
    <div id="gear-toolbar-vars" class="tab">
        <?php foreach ( $vars as $varKey => $varValue ): ?>
            <?php if ( count( $varValue ) ): ?>
                <a href="#"
                   onclick="gearToolbar.toggleDataTable('gears-toolbar-table-vars-<?= $varKey; ?>'); return false;">
                    <h2><?= strtoupper( $varKey ); ?></h2>
                </a>
                <table id="gears-toolbar-table-vars-session">
                    <tbody>
                    <?php foreach ( $varValue as $key => $value ): ?>
                        <tr>
                            <td><?= $key; ?></td>
                            <td><?= $value; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endforeach; ?>

        <h2>Request <span>( HTTP/1.1 )</span></h2>


        <a href="#" onclick="gearToolbar.toggleDataTable('request_headers'); return false;">
            <h3>Headers</h3>
        </a>

        <table id="request_headers_table">
            <tbody>

            <tr>
                <td>Cache-Control</td>
                <td>max-age=0</td>
            </tr>
            <tr>
                <td>Upgrade-Insecure-Requests</td>
                <td>1</td>
            </tr>
            <tr>
                <td>Connection</td>
                <td>keep-alive</td>
            </tr>
            <tr>
                <td>Cookie</td>
                <td>debug-bar-state=open</td>
            </tr>
            <tr>
                <td>Accept-Encoding</td>
                <td>gzip, deflate</td>
            </tr>
            <tr>
                <td>Accept-Language</td>
                <td>en-US,en;q=0.5</td>
            </tr>
            <tr>
                <td>Accept</td>
                <td>text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</td>
            </tr>
            <tr>
                <td>User-Agent</td>
                <td>Mozilla/5.0 (Windows NT 10.0; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0</td>
            </tr>
            <tr>
                <td>Host</td>
                <td>localhost</td>
            </tr>
            <tr>
                <td>Mod-Rewrite</td>
                <td>on</td>
            </tr>
            </tbody>
        </table>

        <a href="#" onclick="gearToolbar.toggleDataTable('cookie'); return false;">
            <h3>Cookies</h3>
        </a>

        <table id="cookie_table">
            <tbody>
            <tr>
                <td>debug-bar-state</td>
                <td>open</td>
            </tr>
            </tbody>
        </table>

        <h2>Response <span>( 200 - OK )</span></h2>

        <a href="#" onclick="gearToolbar.toggleDataTable('response_headers'); return false;">
            <h3>Headers</h3>
        </a>

        <table id="response_headers_table">
            <tbody>
            <tr>
                <td>Cache-control</td>
                <td>no-store, max-age=0, no-cache</td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Logs -->
    <div id="gear-toolbar-logs" class="tab">
        <h2>Logs <span>(20)</span></h2>

        <theader></theader>
        <table>
            <tbody>
            <tr>
                <th>Severity</th>
                <th>Message</th>
            </tr>
            </tbody>
            <tbody>
            <tr>
                <td>info</td>
                <td>Controller "App\Controllers\Home" loaded.</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    gearToolbar.init();
</script>
