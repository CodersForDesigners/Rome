
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
	<head>
	<meta charset="utf-8" />
	<title>Our Cats and All About Them</title>
	<meta name="author" content="Harrison Weir"/>
	<meta name="subject" content="Cats. Their Varieties, Habits and Management; and for show, the Standard of Excellence and Beauty"/>
	<meta name="keywords" content="cats,feline"/>
	<meta name="date" content="2014-12-05"/>

	<style type="text/css">
			
	@page {
		size: 5.5in 8.5in;
		margin: 70pt 60pt 70pt;
	}

	@page:first {
		size: 5.5in 8.5in;
		margin: 0;
	}


	div.frontcover {
		page: cover;
		content: url("images/cover.png");
		width: 100%;
		height: 100%;
	}

	
	@page:right{ 
		@bottom-left {
			margin: 10pt 0 30pt 0;
			border-top: .25pt solid #666;
			content: "Our Cats";
			font-size: 9pt;
			color: #333;
		}

		@bottom-right { 
			margin: 10pt 0 30pt 0;
			border-top: .25pt solid #666;
			content: counter(page);
			font-size: 9pt;
		}

		@top-right {
			content:  string(doctitle);
			margin: 30pt 0 10pt 0;
			font-size: 9pt;
			color: #333;
		}
	}

	
	@page:left {
		@bottom-right {
			margin: 10pt 0 30pt 0;
			border-top: .25pt solid #666;
			content: "Our Cats";
			font-size: 9pt;
			color: #333;
		}

		@bottom-left { 
			margin: 10pt 0 30pt 0;
			border-top: .25pt solid #666;
			content: counter(page);
			font-size: 9pt;
		}
	}


	@page:first {
		@bottom-right {
			content: normal;
			margin: 0;
		}

		@bottom-left {
			content: normal;
			margin: 0;
		}
	}


	/* Reset chapter and figure counters on the body */
	body {
		counter-reset: chapternum figurenum;
		font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
		line-height: 1.5;
		font-size: 11pt;
	}

	/* Get the title of the current chapter, which will be the content of the h1.
	Reset figure counter because figures start from 1 in each chapter. */
	h1 {
		string-set: doctitle content();
		page-break-before: always;
		counter-reset: figurenum;
		counter-reset: footnote;
		line-height: 1.3;
	}

	/* Increment chapter counter */
	h1.chapter:before {
		counter-increment: chapternum;
		content: counter(chapternum) ". ";
	}

	/* Increment and display figure counter */
	figcaption:before {
		counter-increment: figurenum;
		content: counter(chapternum) "-" counter(figurenum) ". ";
	}


	.fn {
		float: footnote;
	}

	.fn {
		counter-increment: footnote;
	}

	.fn::footnote-call {
		content: counter(footnote);
		font-size: 9pt;
		vertical-align: super;
		line-height: none;
	}

	.fn::footnote-marker {
		font-weight: bold;
	}

	@page {
		@footnote {
			border-top: 0.6pt solid black;
			padding-top: 8pt;
		}
	}


	h1, h2, h3, h4, h5 {
		font-weight: bold;
		page-break-after: avoid;
		page-break-inside:avoid;
	}

	h1+p, h2+p, h3+p {
		page-break-before: avoid;
	}

	table, figure {
		page-break-inside: avoid;
	}


	ul.toc a::after {
		content: target-counter(attr(href), page);
	}


	ul.toc a::after {
		content: leader('.') target-counter(attr(href), page);
	}


	</style>
	</head>
	<body>
		<div class="frontcover">
		</div>
		<div class="contents">
			<h1>Extracts from Our Cats and All About Them by Harrison Weir</h1>

				<ul class="toc">
					<li><a href="#ch1">The First Cat Show</a></li>
					<li><a href="#ch2">Trained Cats</a></li>
					<li><a href="#ch3">General Management</a></li>
					<li><a href="#ch4">Superstition and Witchcraft</a></li>
				</ul>

		</div>

		<h1 id="ch1" class="chapter">The First Cat Show</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<h1 id="ch2" class="chapter">Trained Cats</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<h1 id="ch3" class="chapter">General Management</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<h1 id="ch4" class="chapter">Superstition and Witchcraft</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	</body>
</html>
