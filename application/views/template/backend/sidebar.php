            <div class="page-sidebar">
            	<div class="page-sidebar-inner">
            		<div class="page-sidebar-profile">
            			<div class="sidebar-profile-image">
            				<img src="<?= base_url();?>assets/images/avatars/avatar.png" style="border-radius: 50px">
            			</div>
            			<div class="sidebar-profile-info">
            				<a href="javascript:void(0);" class="account-settings-link">
            					<p><?= $this->session->userdata('nama');?></p>
            					<span><?= mb_substr($this->session->userdata('email'), 0, 3) ?>***@<?php $mail = explode("@", $this->session->userdata('email')); echo $mail[1]; ?>
            				</a>
            			</div>
            		</div>
            		<div class="page-sidebar-menu">
            			<div class="sidebar-accordion-menu">
            				<ul class="sidebar-menu list-unstyled">
            					<li>
            						<a href="<?= site_url('pengguna');?>" class="waves-effect waves-grey <?= $this->uri->segment(1) == 'pengguna' && empty($this->uri->segment(2)) ? 'active' : '';?>">
            							<i class="material-icons">settings_input_svideo</i>Dashboard
            						</a>
            					</li>
            					<li>
            						<a href="<?= site_url('pengguna/keuangan');?>" class="waves-effect waves-grey <?= $this->uri->segment(1) == 'pengguna' && $this->uri->segment(2) == 'keuangan' ? 'active' : '';?>">
            							<i class="material-icons">account_balance_wallet</i>Keuangan
            						</a>
            					</li>
            					<li>
            						<a href="<?= site_url('pengguna/pengingat');?>" class="waves-effect waves-grey <?= $this->uri->segment(1) == 'pengguna' && $this->uri->segment(2) == 'pengingat' ? 'active' : '';?>">
            							<i class="material-icons">today</i>Pengingat
            						</a>
            					</li>
            					<li>
            						<a href="<?= site_url('pengguna/riwayat');?>" class="waves-effect waves-grey <?= $this->uri->segment(1) == 'pengguna' && $this->uri->segment(2) == 'riwayat' ? 'active' : '';?>">
            							<i class="material-icons">history</i>Riwayat
            						</a>
            					</li>
            					<li>
            						<a href="<?= site_url('logout');?>" class="waves-effect waves-grey">
            							<i class="material-icons">logout</i>Logout
            						</a>
            					</li>
            				</ul>
            			</div>
            		</div>
            		<div class="sidebar-footer">
            			<p class="copyright">Manajemen Keuangan Mandiri ©2022</p>
            		</div>
            	</div>
            </div><!-- Left Sidebar -->
            <div class="page-content">

            	<div class="container-fluid">
