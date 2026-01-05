<?php
// Basic page shell and shared assets.
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Prediksi Pertumbuhan Janin</title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
	<style>
		* { box-sizing: border-box; }
		body { 
			font-family: 'Poppins', sans-serif; 
			margin: 0; 
			padding: 0; 
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
		}
		
		/* Header */
		.app-header {
			background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
			color: white;
			padding: 20px 30px;
			margin-bottom: 0;
			box-shadow: 0 4px 15px rgba(0,0,0,0.2);
		}
		.app-header h1 {
			margin: 0;
			font-size: 24px;
			font-weight: 600;
			display: flex;
			align-items: center;
			gap: 10px;
		}
		.app-header h1::before {
			content: "👶";
			font-size: 28px;
		}
		.app-header p {
			margin: 5px 0 0 0;
			opacity: 0.85;
			font-size: 14px;
		}
		
		#container { 
			max-width: 1200px; 
			margin: 30px auto; 
			background: #ffffff; 
			padding: 30px; 
			border-radius: 16px;
			box-shadow: 0 10px 40px rgba(0,0,0,0.2);
		}
		
		/* Cards */
		.card {
			background: #fff;
			border-radius: 12px;
			padding: 20px;
			margin-bottom: 20px;
			box-shadow: 0 2px 12px rgba(0,0,0,0.08);
			border: 1px solid #e8ecf1;
		}
		.card-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			padding: 15px 20px;
			border-radius: 10px 10px 0 0;
			margin: -20px -20px 20px -20px;
			font-weight: 600;
			font-size: 16px;
		}
		
		/* Form Layout */
		.form40 { width: 42%; float: left; }
		.form56 { width: 54%; float: left; margin-left: 2%; }
		.left { float: left; }
		.left10 { margin-left: 10px; }
		
		/* Buttons */
		.button_blue { 
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: #fff; 
			padding: 10px 20px; 
			text-decoration: none; 
			border-radius: 8px; 
			cursor: pointer; 
			display: inline-block;
			font-weight: 500;
			font-size: 14px;
			border: none;
			transition: all 0.3s ease;
			box-shadow: 0 4px 15px rgba(102,126,234,0.4);
		}
		.button_blue:hover { 
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(102,126,234,0.5);
		}
		
		.button_green {
			background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
			color: #fff; 
			padding: 10px 20px; 
			text-decoration: none; 
			border-radius: 8px; 
			cursor: pointer; 
			display: inline-block;
			font-weight: 500;
			font-size: 14px;
			border: none;
			transition: all 0.3s ease;
			box-shadow: 0 4px 15px rgba(17,153,142,0.4);
		}
		.button_green:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(17,153,142,0.5);
		}
		
		/* Form Title */
		.formTitle { 
			font-weight: 600; 
			color: #1e3c72; 
			margin: 15px 0 10px 0;
			font-size: 16px;
			padding-bottom: 8px;
			border-bottom: 2px solid #667eea;
			display: inline-block;
		}
		
		/* Inputs */
		input[type="text"], 
		input[type="date"], 
		input[type="password"],
		textarea, 
		select {
			padding: 10px 14px;
			border: 2px solid #e0e6ed;
			border-radius: 8px;
			font-size: 14px;
			font-family: 'Poppins', sans-serif;
			transition: all 0.3s ease;
			outline: none;
		}
		input[type="text"]:focus, 
		input[type="date"]:focus, 
		input[type="password"]:focus,
		textarea:focus, 
		select:focus {
			border-color: #667eea;
			box-shadow: 0 0 0 3px rgba(102,126,234,0.2);
		}
		
		input[type="submit"] {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			padding: 10px 25px;
			border: none;
			border-radius: 8px;
			font-size: 14px;
			font-weight: 500;
			cursor: pointer;
			font-family: 'Poppins', sans-serif;
			transition: all 0.3s ease;
		}
		input[type="submit"]:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(102,126,234,0.4);
		}
		
		/* Tables */
		table { border-collapse: collapse; width: 100%; }
		table td, table th { padding: 12px 10px; text-align: left; }
		
		#tabel_janin {
			width: 100%;
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0 2px 10px rgba(0,0,0,0.08);
		}
		#tabel_janin th {
			background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
			color: white;
			font-weight: 500;
			padding: 14px 12px;
			border: none;
		}
		#tabel_janin td { 
			border: none;
			border-bottom: 1px solid #e8ecf1;
			padding: 12px;
		}
		#tabel_janin tr:hover td {
			background: #f8f9ff;
		}
		#tabel_janin tr:last-child td {
			border-bottom: none;
		}
		
		/* Logout link */
		.logout-link {
			color: #e74c3c;
			text-decoration: none;
			font-weight: 500;
			padding: 8px 16px;
			border: 2px solid #e74c3c;
			border-radius: 6px;
			transition: all 0.3s ease;
		}
		.logout-link:hover {
			background: #e74c3c;
			color: white;
		}
		
		/* Chart container */
		.chart-container {
			background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
			border-radius: 12px;
			padding: 20px;
			text-align: center;
			min-height: 400px;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.chart-container img {
			max-width: 100%;
			border-radius: 8px;
			box-shadow: 0 4px 20px rgba(0,0,0,0.1);
		}
		
		/* Login form */
		.login-box {
			max-width: 400px;
			margin: 50px auto;
			background: white;
			padding: 40px;
			border-radius: 16px;
			box-shadow: 0 10px 40px rgba(0,0,0,0.2);
		}
		.login-box h2 {
			text-align: center;
			color: #1e3c72;
			margin-bottom: 30px;
			font-size: 28px;
		}
		.login-box label {
			font-weight: 500;
			color: #333;
			display: block;
			margin-bottom: 5px;
		}
		.login-box input[type="text"],
		.login-box input[type="password"] {
			width: 100%;
			margin-bottom: 20px;
		}
		.login-box button {
			width: 100%;
			padding: 14px;
			font-size: 16px;
		}
		
		/* Edit patient link */
		.edit-link {
			color: #667eea;
			cursor: pointer;
			font-weight: 500;
			transition: color 0.3s;
		}
		.edit-link:hover {
			color: #764ba2;
			text-decoration: underline;
		}
		
		/* Notification */
		#saving_notification {
			background: #27ae60;
			color: white;
			padding: 10px 20px;
			border-radius: 8px;
			position: fixed;
			top: 20px;
			right: 20px;
			z-index: 1000;
			font-weight: 500;
		}
		
		/* Responsive */
		@media (max-width: 900px) {
			.form40, .form56 {
				width: 100%;
				float: none;
				margin-left: 0;
			}
			#container {
				margin: 15px;
				padding: 20px;
			}
		}
		
		/* Clear fix */
		.clearfix::after {
			content: "";
			display: table;
			clear: both;
		}
	</style>
</head>
<body>
<div class="app-header">
	<h1>Prediksi Pertumbuhan Janin</h1>
	<p>Sistem Monitoring Tinggi Fundus & Berat Janin</p>
</div>
<div id="container">
