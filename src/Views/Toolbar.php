<nav id="view-toolbar" class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url(); ?>">
				<img src="<?php echo upload_url( 'images/favicon.png' ); ?>">
			</a>

		</div>

		<!-- BUTTON CATALOG MENU -->
		<button id="button-catalog" type="button" class="btn btn-default" href="javascript:void(0)"><i class="fa fa-gears"></i> <span>Tema</span></button>

		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a data-action="view-port-reload" href="javascript:void(0);">
						<i class="fa fa-refresh"></i> <span>Reload</span>
					</a>
				</li>
				<li class="dropdown">
					<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="entypo-monitor"></i> <span>Desktop</span>
					</a>

					<ul class="dropdown-menu sub-menu">
						<li>
							<a data-action="view-port" data-width="1024" href="javascript:void(0);">
								<span>XGA</span>
								<label class="pull-right label label-info">1024px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="1056" href="javascript:void(0);">
								<span>XGA+</span>
								<label class="pull-right label label-info">1056px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="1152" href="javascript:void(0);">
								<span>XGA+</span>
								<label class="pull-right label label-info">1152px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="1280" href="javascript:void(0);">
								<span>SXVGA</span>
								<label class="pull-right label label-info">1280px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="1360" href="javascript:void(0);">
								<span>HD</span>
								<label class="pull-right label label-info">1360px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="1366" href="javascript:void(0);">
								<span>HD+</span>
								<label class="pull-right label label-info">1366px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="1400" href="javascript:void(0);">
								<span>SXVGA+</span>
								<label class="pull-right label label-info">1400px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="1440" href="javascript:void(0);">
								<span>WXGA+</span>
								<label class="pull-right label label-info">1440px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="1680" href="javascript:void(0);">
								<span>WSXGA+</span>
								<label class="pull-right label label-info">1680px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="1600" href="javascript:void(0);">
								<span>UXGA</span>
								<label class="pull-right label label-info">1600px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="1920" href="javascript:void(0);">
								<span>WUXGA</span>
								<label class="pull-right label label-info">1920px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="2048" href="javascript:void(0);">
								<span>QXGA</span>
								<label class="pull-right label label-info">2048px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="2560" href="javascript:void(0);">
								<span>WQXGA</span>
								<label class="pull-right label label-info">2560px</label>
							</a>
						</li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="entypo-mobile"></i> <span>Mobile</span>
					</a>

					<ul class="dropdown-menu sub-menu">
						<li>
							<a data-action="view-port" data-width="240" href="javascript:void(0);">
								<span>HQVGA</span>
								<label class="pull-right label label-info">240px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="320" href="javascript:void(0);">
								<span>QVGA</span>
								<label class="pull-right label label-info">320px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="480" href="javascript:void(0);">
								<span>WQVGA</span>

								<label class="pull-right label label-info">480px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="640" href="javascript:void(0);">
								<span>VGA</span>
								<label class="pull-right label label-info">640px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="720" href="javascript:void(0);">
								<span>PAL</span>

								<div class="pull-right label label-info">720px</div>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="768" href="javascript:void(0);">
								<span>PAL+</span>
								<label class="pull-right label label-info">768px</label>
							</a>
						</li>

						<li>
							<a data-action="view-port" data-width="800" href="javascript:void(0);">
								<span>SVGA</span>
								<label class="pull-right label label-info">800px</label>
							</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="<?php echo base_url( 'tutorial' ); ?>" target="_blank">
						<i class="entypo-help-circled"></i> <span>Help</span>
					</a>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>