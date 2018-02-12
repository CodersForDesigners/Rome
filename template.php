<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Page Title</title>
	<style type="text/css">
		/**
		 * Print Stylesheet fuer Deinewebsite.de
		* @version         1.0
		* @lastmodified    16.06.2016
		*/

		/*	--
		***	Pixels => Points
		*	6px => 5pt			*	11px => 8pt			*	16px => 12pt		*	21px => 16pt
		*	7px => 5pt			*	12px => 9pt			*	17px => 13pt		*	22px => 17pt
		*	8px => 6pt			*	13px => 10pt		*	18px => 14pt		*	23px => 17pt
		*	9px => 7pt			*	14px => 11pt		*	19px => 14pt		*	24px => 18pt
		*	10px => 8pt			*	15px => 11pt		*	20px => 15pt
		***
		--	*/

		@media screen {
			body > * { display: none; }
			body:after {
				content: 'Press: Command + P';
			}


			/* -- PRINT HELPER CLASSES -- */
			.page-break	{ display: none; }
		}

		@media print {

			/** Setting Page size and margins */
			@page {
				size: A4;
				margin: 2cm;
			}

			/* Set font to 16px/13pt, set background to white and font to black.*/
			/* This saves ink */
			body {
				color: #000;
				font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
				font-size: 13pt;
				line-height: 1.3;
				background: #fff !important;
			}

			h1 {
				font-size: 24pt;
			}

			h2, h3, h4 {
				font-size: 14pt;
				margin-top: 25px;
			}

			/* Defining all page breaks */
			a {
				page-break-inside:avoid
			}
			blockquote {
				page-break-inside: avoid;
			}
			h1, h2, h3,
			h4, h5, h6 { page-break-after:avoid;
				page-break-inside:avoid; }
			img { page-break-inside:avoid;
				page-break-after:avoid; }
			table, pre { page-break-inside:avoid; }
			ul, ol, dl  { page-break-before:avoid; }

			/* Displaying link color and link behaviour */
			a:link, a:visited, a {
				background: transparent;
				color: #520;
				font-weight: bold;
				text-decoration: underline;
				text-align: left;
			}

			a {
				page-break-inside:avoid;
			}

			a[href^=http]:after {
				content:" <" attr(href) "> ";
			}

			$a:after > img {
				content: "";
			}

			article a[href^="#"]:after {
				content: "";
			}

			a:not(:local-link):after {
				content:" <" attr(href) "> ";
			}


			/* Define Important Elements */
			p, address, li, dt, dd, blockquote {
				font-size: 100%;
			}

			/* Font for Code Samples */
			code, pre { font-family: "Courier New", Courier, mono}

			ul, ol {
				list-style: square;
				margin-left: 18pt;
				margin-bottom: 20pt;
			}

			li {
				line-height: 1.6em;
			}



			/* -- PRINT HELPER CLASSES -- */
			.page-break {
				display: block;
				width: 100%;
				page-break-after: always;
			}
		}
	</style>
</head>
<body>

	<div class="page">
		<h1>Unit Number: <?php echo $unit_number; ?></h1>
		<h4>Name: <?php echo $name; ?></h4>
		<h4>Phone: <?php echo $phone; ?></h4>
		<h4>Email: <?php echo $email; ?></h4>
		<h2>Built-up Area: <?php echo $built_up_area; ?> SQFT</h2>
		<h4>Floor: <?php echo $floor; ?></h4>
		<h4>Block: <?php echo $block; ?></h4>
		<h2>Rate/SQFT: ₹<?php echo $rate_per_sqft; ?></h2>
		<h2>Basic Cost: ₹<?php echo $basic_cost; ?></h2>
		<h2>Floor Rise: ₹<?php echo $floor_rise; ?></h2>
		<h1>Grand Total: ₹<?php echo $grand_total; ?></h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
	<div class="page-break"></div>
	<div class="page">
		<h1>Pricing Details</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
	<div class="page-break"></div>
	<div class="page">
		<h1>Pricing Details</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
</body>
</html>
