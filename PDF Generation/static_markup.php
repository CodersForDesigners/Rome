<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Page Title</title>

	<style type="text/css">

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

		a:after > img {
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

	</style>

</head>

<body>

	<div class="page">

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
