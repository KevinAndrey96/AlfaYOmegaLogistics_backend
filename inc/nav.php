		<?php
		session_start();
		?>
		<aside id="left-panel">
			<div class="login-info">
				<span> 
					
					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
						<img src="<?php echo ASSETS_URL; ?>/img/avatars/<?php 
						if (file_exists ('img/avatars/'.$_SESSION['Documento'].'.jpg'))
						echo $_SESSION['Documento'];
						else
						echo "default";
						?>.jpg" alt="me" class="online" /> 
						<span>
							<?php 
							echo $_SESSION['Nombres'];
							?>
						</span>
						<i class="fa fa-angle-down"></i>
					</a> 
					
				</span>
			</div>
			
			
			<nav>
				<?php
				$ui = new SmartUI();
				$ui->create_nav($page_nav)->print_html();
				?>

			</nav>
			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>