<?php
session_start();

$html = <<<HTML
<a href="/movies/#oldskool">Old-Skool</a>
HTML;

if ( isset( $_SESSION["user"] ) ) {
	$username = $_SESSION["user"]["first_name"] . ' ' . $_SESSION["user"]["last_name"];

	$html = <<<HTML
	<a href="/logout.php"><b>{$username}</b></a>
	HTML;
}

var_dump($html);
?>
<header>
	<nav>
		<div class="left">
			<a href="/">
				<img src="/resources/images/logo.png" alt="LOGO" />
			</a>
		</div>

		<input type="checkbox" id="menu-toggle" hidden />
		<label for="menu-toggle" class="menu-btn">
			<span class="btn"></span>
		</label>

		<div class="right">
			<ul>
				<li>
					<a href="/movies/">Films</a>
					<ul>
						<li><a href="/movies/#action">Actie</a></li>
						<li><a href="/movies/#comedy">Comedie</a></li>
						<li><a href="/movies/#horror">Horror</a></li>
						<li><a href="/movies/#romance">Romantiek</a></li>
						<li><a href="/movies/#oldskool">Old-Skool</a></li>
					</ul>
				</li>
				<li><?= $html ?></li>
			</ul>
		</div>
	</nav>
</header>
