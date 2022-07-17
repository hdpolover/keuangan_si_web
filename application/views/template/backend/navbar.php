        <div class="alpha-app">
        	<div class="page-header">
        		<nav class="navbar navbar-expand primary">
        			<section class="material-design-hamburger navigation-toggle">
        				<a href="javascript:void(0)" data-activates="slide-out"
        					class="button-collapse material-design-hamburger__icon">
        					<span class="material-design-hamburger__layer"></span>
        				</a>
        			</section>
        			<a class="navbar-brand" href="#">CatatanUangku</a>
        			<button class="navbar-toggler" type="button" data-toggle="collapse"
        				data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        				aria-expanded="false" aria-label="Toggle navigation">
        				<span class="navbar-toggler-icon"></span>
        			</button>

        			<div class="collapse navbar-collapse" id="navbarSupportedContent">
        				<ul class="navbar-nav ml-auto">
        					<?php if($this->session->userdata('role') == 2):?>
        					<li class="nav-item dropdown d-none d-lg-block">
        						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
        							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        							<i class="material-icons">notifications_none</i>
        							<?php if(!empty($pengingat_notif)):?>
        							<span class="badge"><?= count($pengingat_notif);?></span>
        							<?php endif;?>
        						</a>
        						<ul class="dropdown-menu dropdown-menu-right dd-notifications"
        							aria-labelledby="navbarDropdown">
        							<?php if(!empty($pengingat_notif)):?>
        							<?php foreach($pengingat_notif as $key => $val):?>
        							<li>
        								<a href="<?= site_url('pengguna/pengingat');?>">
        									<div class="notification">
        										<div class="notification-icon circle cyan"><i
        												class="material-icons">notifications</i></div>
        										<div class="notification-text">
        											<p><?= $val->nama;?></p>
        											<span><?= date("d F Y", $val->tanggal);?></span>
        											<span class="badge badge-warning text-dark float-right">belum
        												dibayar</span>
        										</div>
        									</div>
        								</a>
        							</li>
        							<?php endforeach;?>
        							<?php endif;?>
        						</ul>
        					</li>
        					<?php endif;?>
        					<li class="nav-item">
        						<a class="nav-link" href="<?= site_url('logout');?>"><i
        								class="material-icons">logout</i></a>
        					</li>
        				</ul>
        			</div>
        		</nav>
        	</div><!-- Page Header -->
