<?php
$userinfo = $this->Session->read('Auth.User.Account');
$role = -1;//means everyone
if ($userinfo) {
	$role = $userinfo['role'];
}

$menuitemscount = 0;
$curmenuidx = 0;
?>
<!doctype html>
<html lang="en">
<head>
<title><?php echo $title_for_layout; ?></title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php
echo $this->Html->meta('icon', $this->Html->url('/../favicon.ico'), array('type' => 'icon'));

/*for bootstrap 3*/
echo $this->Html->css('../bootstrap4.3.1/css/bootstrap.min');
echo $this->Html->script('jquery-3.3.1.min');
echo $this->Html->script('popper.min');
//echo $this->Html->script('../bootstrap4.3.1/js/bootstrap.bundle.min');
echo $this->Html->script('../bootstrap4.3.1/js/bootstrap.min');

/*for Font Awesome 3*/
echo $this->Html->css('../fontawesome3.2.1/css/font-awesome.min');

/*for jQuery datapicker*/
echo $this->Html->css('jQuery/Datepicker/dp_gray');
echo $this->Html->script('jquery-ui.min');

echo $this->Html->css('mine');
?>

<?php 
/*for self-developed zToolkits*/
echo $this->Html->script('zToolkits');

/*for CKEditor*/
echo $this->Html->script('ckeditor/ckeditor');

/*for fancybox*/
echo $this->Html->css('jquery.fancybox.min');
echo $this->Html->script('jquery.fancybox.min');

/*for AJAX*/
echo $this->Html->script('ajax/prototype');
echo $this->Html->script('ajax/scriptaculous');

echo $scripts_for_layout;

?>
</head>
<body style="background:black;">
<div class="container-fluid bg-black p-0 zMaxWidth">
	<div class="container-fluid bg-black" style="min-height:18px;"></div>
	<div class="container-fluid" style="min-height:8px;background:black;"></div>
	<div class="container-fluid bg-black p-0">
		<div id="divGetPaidInvisibleLine" class="float-right" style="width:280px;height:0px;background:black;"></div>
		<div class="w-100">
		<?php 
		echo $this->Html->image(
			'HEADER-sm.jpg', 
			array(
				'class' => 'img-fluid',
				//'style' => 'height:180px;'
			)
		);
		?>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">		
		<?php
		echo $this->Html->link('<i class="icon-home"></i>' . 'HOME',
			array('controller' => 'accounts', 'action' => 'index'),
			array('class' => 'navbar-brand font-weight-bold', 'escape' => false), 
			false
		);
		?>
		<button class="navbar-toggler" 
			type="button" 
			data-toggle="collapse" 
			data-target="#navbarSupportedContent" 
			aria-controls="navbarSupportedContent" 
			aria-expanded="false" 
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<?php
				if ($role == 0) {//means an administrator
					echo $this->Html->link('TEAMS',
						array('controller' => 'accounts', 'action' => 'lstcompanies', 'id' => -1),
						array('class' => 'nav-link text-white font-weight-bold', 'escape' => false),
						false
					);
				}
				?>
			</li>
			<li class="nav-item">
				<?php
				if ($role == 0) {//means an administrator
					echo $this->Html->link('SELLERS',
						array('controller' => 'accounts', 'action' => 'lstagents', 'id' => -1),
						array('class' => 'nav-link text-white font-weight-bold', 'escape' => false),
						false
					);
				}
				if ($role == 1) {//means an office
					echo $this->Html->link('SELLERS',
						array('controller' => 'accounts', 'action' => 'lstagents', 'id' => $userinfo['id']),
						array('class' => 'nav-link text-white font-weight-bold', 'escape' => false),
						false
					);
				}
				?>
			</li>
			<li class="nav-item">
				<?php
				if ($role == 0) {//means an administrator
					echo $this->Html->link('NEW STAFF',
						array('controller' => 'accounts', 'action' => 'lstnewmembers'),
						array('class' => 'nav-link text-white font-weight-bold float-left', 'escape' => false),
						false
					);
					if ($newCounts != 0) {
				?>
					<span id="spanNewStaff" class="badge badge-danger float-left">
						<?php echo $newCounts;?>
					</span>
				<?php
					}
				}
				?>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link text-white font-weight-bold dropdown-toggle" 
					href="#" id="navbarDropdownSite" 
					role="button" data-toggle="dropdown" 
					aria-haspopup="true" 
					aria-expanded="false">
				LINKS
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownSite">
					<?php
					echo $this->Html->link('LINKS',
						array('controller' => 'links', 'action' => 'lstlinks'),
						array('class' => 'dropdown-item', 'escape' => false), 
						false
					);
					if ($role == 0) {
						echo $this->Html->link('Config Site',
							array('controller' => 'links', 'action' => 'updsite'),
							array('class' => 'dropdown-item', 'escape' => false), 
							false
						);
					}
					?>
				</div>
			</li>
			<li class="nav-item">
				<?php
				echo $this->Html->link('STATS',
					//array('controller' => 'stats', 'action' => 'statscompany', 'clear' => -2),
					array('controller' => 'stats', 'action' => 'statsdate', 'clear' => -2),
					array('id' => 'navbarStats', 'class' => 'nav-link text-white font-weight-bold', 'escape' => false),
					false
				);
				?>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link text-white font-weight-bold dropdown-toggle" 
					href="#" id="navbarDropdown" 
					role="button" data-toggle="dropdown" 
					aria-haspopup="true" 
					aria-expanded="false">
				LOGS
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<?php
					if ($role == 2) {
						echo $this->Html->link('Submit Chat Log',
							array('controller' => 'accounts', 'action' => 'addchatlogs'),
							array('class' => 'dropdown-item', 'escape' => false), 
							false
						);
					}
					echo $this->Html->link('Chat Log',
						array('controller' => 'accounts', 'action' => 'lstchatlogs', 'id' => -1),
						array('class' => 'dropdown-item', 'escape' => false), 
						false
					);
					echo $this->Html->link('Click Log',
						array('controller' => 'links', 'action' => 'lstclickouts', 'id' => -1),
						array('class' => 'dropdown-item', 'escape' => false), 
						false
					);
					?>
					<div class="dropdown-divider"></div>
					<?php
						if ($role != 2) {
							echo $this->Html->link('Login Log',
								array('controller' => 'accounts', 'action' => 'lstlogins', 'id' => -1),
								array('class' => 'dropdown-item', 'escape' => false), 
								false
							);
						}
					?>
				</div>
			</li>
			<!--
			<li class="nav-item">
				<?php
				/*
				echo $this->Html->link('GET HELP',
					array('controller' => 'accounts', 'action' => 'contactus'),
					array('class' => 'nav-link text-white font-weight-bold', 'escape' => false),
					false
				);*/
				?>
			</li>
			-->
			<li class="nav-item">
				<?php
				if ($role == 0) {//means an administrator
					echo $this->Html->link('ME',
						array('controller' => 'accounts', 'action' => 'updadmin'),
						array('class' => 'nav-link text-white font-weight-bold', 'escape' => false),
						false
					);
				}
				if ($role == 1) {//means an office
					echo $this->Html->link('ME',
						array('controller' => 'accounts', 'action' => 'updcompany', 'id' => $userinfo['id']),
						array('class' => 'nav-link text-white font-weight-bold', 'escape' => false),
						false
					);
				}
				if ($role == 2) {//means an agent
					echo $this->Html->link('ME',
						array('controller' => 'accounts', 'action' => 'updagent', 'id' => $userinfo['id']),
						array('class' => 'nav-link text-white font-weight-bold', 'escape' => false),
						false
					);
				}
				?>
			</li>
			<li class="nav-item">
				<?php
				if ($role == 0) {//means an administrator
					echo $this->Html->link('ALERTS',
						array('controller' => 'accounts', 'action' => 'addnews'),
						array('class' => 'nav-link text-white font-weight-bold', 'escape' => false),
						false
					);
				}
				?>
			</li>
			<?php
			if (FALSE && in_array($userinfo['id'], array(1, 2))) {//HARD CODE: means an administrator whoes id is 1 or 2
			?>
			<li class="nav-item dropdown">
				<a class="nav-link text-white font-weight-bold dropdown-toggle" 
					href="#" id="navbarDropdownLEADS" 
					role="button" data-toggle="dropdown" 
					aria-haspopup="true" 
					aria-expanded="false">
				LEADS
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownLEADS">
					<?php
						echo $this->Html->link('Update 1',
							array('controller' => 'accounts', 'action' => 'updtoolbox', 'site' => 1),
							array('class' => 'dropdown-item', 'escape' => false), 
							false
						);
						echo $this->Html->link('Update 2',
							array('controller' => 'accounts', 'action' => 'updtoolbox', 'site' => 2),
							array('class' => 'dropdown-item', 'escape' => false), 
							false
						);
					?>
				</div>
			</li>
			<?php
			}
			?>
			<li class="nav-item">
				<?php
					echo $this->Html->link('<i class="icon-signout"></i>' . 'LEAVE',
						array('controller' => 'accounts', 'action' => 'logout'),
						array('class' => 'nav-link text-white font-weight-bold', 'escape' => false),
						false
					);
				?>
			</li>
			</ul>
		</div>
	</nav>
	<div class="container-fluid px-2">
		<div class="float-left">
			<div class="text-left text-success font-weight-bold">
				<?php
				$title_for_page = "";
				if (strpos($this->request->here, 'lstcompanies') !== false) {
					$title_for_page = "Teams";
				} else if (strpos($this->request->here, 'lstagents') !== false) {
					$title_for_page = "Sellers";
				} else if (strpos($this->request->here, 'lstnewmembers') !== false) {
					$title_for_page = "New Staff";
				} else if (strpos($this->request->here, 'lstlinks') !== false) {
					$title_for_page = "Link Codes";
				} else if (strpos($this->request->here, 'statscompany') !== false) {
					$title_for_page = "Stats";
				} else if (strpos($this->request->here, 'lstchatlogs') !== false) {
					$title_for_page = "Chat Logs";
				} else if (strpos($this->request->here, 'lstclickouts') !== false) {
					$title_for_page = "Click Logs";
				} else if (strpos($this->request->here, 'lstlogins') !== false) {
					$title_for_page = "Log in/out Logs";
				} else if (strpos($this->request->here, 'contactus') !== false) {
					$title_for_page = "Get Help";
				} else if (strpos($this->request->here, 'updadmin') !== false) {
					$title_for_page = "Profile";
				} else if (strpos($this->request->here, 'updcompany') !== false) {
					$title_for_page = "Profile";
				} else if (strpos($this->request->here, 'updagent') !== false) {
					$title_for_page = "Profile";
				} else if (strpos($this->request->here, 'regcompany') !== false) {
					$title_for_page = "New Team";
				} else if (strpos($this->request->here, 'regagent') !== false) {
					$title_for_page = "New Seller";
				} else if (strpos($this->request->here, 'requestchg') !== false) {
					$title_for_page = "Request Changes Just Sent ...";
				} else if (strpos($this->request->here, 'addnews') !== false) {
					$title_for_page = "Add Alert";
				} else if (strpos($this->request->here, 'updalerts') !== false) {
					$title_for_page = "Update Pop Up";
				} else if (strpos($this->request->here, 'updtoolbox') !== false) {
					$title_for_page = "Leads";
				} else if (strpos($this->request->here, 'addchatlogs') !== false) {
					$title_for_page = "Submit Chat Log";
				} else if (strpos($this->request->here, 'addsite') !== false) {
					$title_for_page = "Add Site";
				} else if (strpos($this->request->here, 'lstcampaigns') !== false) {
					$title_for_page = "Campaigns";
				} else if (strpos($this->request->here, 'lstclickouts') !== false) {
					$title_for_page = "Click Logs";
				} else if (strpos($this->request->here, 'lstlinks') !== false) {
					$title_for_page = "Link Codes";
				} else if (strpos($this->request->here, 'lstsites') !== false) {
					$title_for_page = "Sites";
				} else if (strpos($this->request->here, 'lsttypes') !== false) {
					$title_for_page = "Types";
				} else if (strpos($this->request->here, 'updsite') !== false) {
					$title_for_page = "Update Site";
				} else if (strpos($this->request->here, 'updtype') !== false) {
					$title_for_page = "Update Type";
				} else if (strpos($this->request->here, 'stats') !== false) {
					$title_for_page = "Stats";
				} else if (strpos($this->request->here, 'top10') !== false) {
					$title_for_page = "Top Sales";
				} else {
					$title_for_page = "HOME";
				}

				echo $title_for_page;
				?>
			</div>
			<div class="badge badge-secondary d-inline-flex text-left text-white font-weight-bold p-1">
				<div class="text-left"><i class="icon-user"></i></div><?php echo '&nbsp' . $userinfo['username'];?>
			</div>
		</div>

		<div class="float-right m-0" style="font-size:12px;">
			<div class="float-right text-right">
				<input type="text" value="" id="iptClock"
					class="text-right text-dark font-weight-bold bg-transparent"
					style="width:240px;border:0;"
					readonly="readonly"
					onmouseover="jQuery('#divTimezoneTip').slideDown();"
					onmouseout="jQuery('#divTimezoneTip').slideUp();" />
				<div><font color="red">EST-EDT: Stats Time zone</font></div>
				<div><a href="https://www.timeanddate.com/worldclock">https://www.timeanddate.com/worldclock</a></div>
			</div>
			<div class="float-right mr-2 text-dark"
				style="display:none;"
				id="divTimezoneTip">
				<script language="javascript">
				document.write("Your timezone: " + calculate_time_zone() + "");
				</script>
			</div>
			<script language="javascript">
			function __zShowClock() {
				var now = new Date();
				/*
				2 a.m. on the Second Sunday in March 
				to 2 a.m. on the First Sunday of November, 
				GMT - 4 (Other time, GMT - 5)
				*/
				var secSundayInMar = new Date();
				var frtSundayInNov = new Date();
				secSundayInMar.setUTCMonth(2);
				secSundayInMar.setUTCDate(1);
				secSundayInMar.setUTCHours(2);
				secSundayInMar.setUTCMinutes(0);
				secSundayInMar.setUTCSeconds(0);
				secSundayInMar.setUTCMilliseconds(0);
				var i = 0;
				while (secSundayInMar.getUTCDay() != 0) {
					i++;
					secSundayInMar.setUTCDate(i);
				}
				secSundayInMar.setUTCDate(i + 7);
				frtSundayInNov.setUTCMonth(10);
				frtSundayInNov.setUTCDate(1);
				frtSundayInNov.setUTCHours(2);
				frtSundayInNov.setUTCMinutes(0);
				frtSundayInNov.setUTCSeconds(0);
				frtSundayInNov.setUTCMilliseconds(0)
				i = 0;
				while (frtSundayInNov.getUTCDay() != 0) {
					i++;
					frtSundayInNov.setUTCDate(i);
				}

				if (now >= secSundayInMar && now <= frtSundayInNov) {
					now.setHours(now.getHours() - 4);
				} else {
					now.setHours(now.getHours() - 5);
				};
				
				var nowStr = now.toUTCString();
				nowStr = nowStr.replace("GMT", "EDT"); //for firefox browser
				nowStr = nowStr.replace("UTC", "EDT"); //for IE browser

				//nowStr += ("(" + secSundayInMar.toUTCString() + "_" + frtSundayInNov.toUTCString() + ")");
				
				jQuery("#iptClock").val(nowStr);
				setTimeout("__zShowClock()", 1000);
			}
			__zShowClock();
			</script>
		</div>

	</div>
	<div class="container-fluid px-2 bg-light">
		<center>
			<b><font color="red"><?php echo $this->Session->flash(); ?> </font> </b>
		</center>
		<div class="w-100 p-0">

			<?php echo $content_for_layout; ?>

		</div>
	</div>
	<div class="container-fluid bg-dark text-white">
		<center>
			Alexanderplatz Gontard  Strasse 11  Berlin Deutschland EU 
			Copyright &copy; 2020 All Rights, Reserved.<BR/>
			<a href="Https://www.GlobalNetworkAds.com">Https://www.GlobalNetworkAds.com</a> 
			<br/>
		</center>
	</div>
	<div class="container-fluid" style="min-height:8px;background:black;"></div>
	<div class="container-fluid bg-black" style="min-height:18px;"></div>
</div>

	<!-- for "agent must read" -->
	<?php
	if (in_array($userinfo['role'], array(0, 1, 2)) && !$this->Session->check('switch_pass')) {
	?>
	<div style="display:none">
		<a id="attentions_link" href="#attentions_for_agents">show attentions</a>
	</div>
	<div style="display:none">
		<div id="attentions_for_agents" style="width: 800px;">
		<!--  
		<p class="p-blink" style="font:italic bolder 24px/100% Georgia;color:red;margin:0px 0px 6px 0px;">
		ATTENTION, EVERYONES: 
		</p>
		-->
			<script type="text/javascript" language="javascript">
			/*//we just don't blink the title of the alerts here
			colors = new Array(6);
			colors[0] = "#ff0000";
			colors[1] = "#ff2020";
			colors[2] = "#ff4040";
			colors[3] = "#ff6060";
			colors[4] = "#ff8080";
			colors[5] = "#ffffff";
			var clr_i = 0;
			function __blinkIt() {
				if (clr_i < colors.length) {
					jQuery(".p-blink").css("color", colors[clr_i]);
					clr_i++;
					setTimeout("__blinkIt()", 200);
				} else {
					clr_i = 0;
					setTimeout("__blinkIt()", 1200);
				}
			}
			__blinkIt();
			*/
			</script>
			<p style="padding: 3px 3px 3px 3px;">
				<?php
				echo !empty($alerts) ? $alerts : '';
				?>
			</p>

			<hr style="margin: 6px 0px 6px 0px" />
			<hr style="margin: 6px 0px 6px 0px" />

			<?php
			if (!empty($excludedsites)) {
			?>
			<p style="font-weight: bold; font-size: 14px; color: red;">
				YOUR
				<?php echo '"' . implode("\", \"", $excludedsites) . '"'; ?>
				LINKS HAVE BEEN SUSPENDED, PLEASE CONTACT <a
					href="mailto:SUPPORT@globalnetworkads.com"><font color="red">THE 
						GLOBALNETADVERTISING SUPPORT</font> </a> FOR MORE INFO.<br /> <a
					href="mailto:SUPPORT@globalnetworkads.com"><font color="red">SUPPORT@GlobalNetworkAds.com</font>
				</a>
			</p>
			<div style="margin: 12px 2px 2px 2px; font-weight: bolder;">REASONS
				FOR TEMPORARY SUSPENSION</div>
			<p style="font-size: 14px; color: red;">
				<br/>
				1.SENDING LOW QUALITY SALES,  CUSTOMERS WHO DO NOT SPEND MONEY.<br/><br/>
				2.CREATING FAKE ACCOUNTS.<br/><br/>
				3.USING STOLEN CARDS.<br/><br/>
				4.TELLING CUSTOMER SITE IS FREE.<br/><br/>
				5.TELLING CUSTOMER YOU WILL MEET HIM.<br/>
			</p>
			<?php
			}
			?>

			<center><div>
				<?php
				echo $this->Html->link('<font style="font-weight:bold;font-size:20px;color:black;">LET ME IN</font>',
					"#",
					array('onclick' => 'javascript:jQuery.fancybox.close();jQuery.post(\'' 
						. $this->Html->url(array("controller" => "accounts", "action" => "pass")) 
						. '\', function(data) {});',
						'class' => 'button',
						'style' => 'text-decoration:none;',
						'escape' => false
					),
					false
				);
				?>
			</div></center>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery("a#attentions_link").fancybox({
				'type': 'inline',
				'overlayOpacity': 0.6,
				'overlayColor': '#0A0A0A',
				'modal': true
			});
			//jQuery("a#attentions_link").click();

			/*
			jQuery(".navbar-nav li a").click(function() {
				//alert(jQuery(this).html());
				jQuery(this).removeClass("text-white").siblings().addClass("text-white");
			})
			*/

			var urlName = window.location.pathname;
			jQuery(".navbar-nav li a").each(function() {   
				var urlHref = jQuery(this).attr('href');
				if (urlName.indexOf(urlHref)>=0) {
					jQuery(this).removeClass("text-white");
				} else {
					if (urlName.indexOf('chatlogs') >= 0 || urlName.indexOf('clickouts') >= 0 || urlName.indexOf('logins') >= 0) {
						jQuery("#navbarDropdown").removeClass("text-white");
					} else if (urlName.indexOf('link') >= 0 || (urlName.indexOf('site') >= 0 && urlName.indexOf('siteid') < 0)) {
						jQuery("#navbarDropdownSite").removeClass("text-white");
					} else if (urlName.indexOf('stats') >= 0) {
						jQuery("#navbarStats").removeClass("text-white");
					}
				}
			});

			/* fix the bug that it will hide back whenever click the dropdown main menu */
			jQuery('.nav-item,.dropdown').on('hidden.bs.dropdown', function () {
				jQuery('.nav-item,.dropdown').show();
			});

			/* blink the badge of the "new staff" numbers */
			<?php
			if ($newCounts != 0) {
			?>
			function blink(selector){
				jQuery(selector).fadeOut(1200, function(){
					jQuery(this).fadeIn(1200, function(){
						blink(this);
					});
				});
			}
			blink("#spanNewStaff");
			<?php
			}
			?>
		});
	</script>

		<?php /*show fake sellers get paid message block below */ ?>
		<?php
		if (false && (strpos($this->request->here, 'stats') !== false
			|| $title_for_page === 'HOME')) {
		?>
		<div id="divGetpaid" class="rounded bg-light p-0" style="border:6px solid black;width:270px;display:none;">
			<div class="container-fluid row w-100">
			<?php
			echo $this->Html->image(
				'PERSON-md.png', 
				array(
					'class' => 'float-left',
					'style' => 'width:48px;height:48px;'
				)
			);
			?>
			</div>
			<!--
			<div class="container-fluid row w-100">
				<marquee class="w-100" scrollAmount=3 direction="left">
				<div id="divMarquee" class="w-100">
				</div>
				</marquee>
			</div>
			-->
		</div>
		<script type="text/javascript">
			jQuery("#divGetPaidInvisibleLine").click(function(){
				if (isPC()) {
					// do nothing
				} else {
					// move divGetPaidInvisibleLine to the top
					jQuery("#divGetPaidInvisibleLine").css({"position":"absolute", "top":"0"});
				}
				var box = jQuery("#divGetpaid");
				if(box != undefined){
					box.addClass("wbx").css({
						position:"absolute",
						left:jQuery(this).offset().left,
						top:jQuery(this).offset().top+jQuery(this).outerHeight()+5,
						zIndex:100
					});
					//box.slideUp(200);
					box.hide();
					box.slideDown("slow");
				}
			});
			function showGetPaid() {
				jQuery("#divMarquee").load("/GNA/accounts/slide");
				//jQuery("#divGetPaidInvisibleLine").click();
			}
			jQuery("#divGetPaidInvisibleLine").click();
			<?php
			if ($role == 0) {
			?>
			showGetPaid();
			var t1 = window.setInterval(showGetPaid,20000);
			<?php
			}
			?>
		</script>
		<?php
		}
		?>

	<?php
	}
	?>

	<?php
		echo $this->Js->writeBuffer(); 
	?>
</body>
</html>
