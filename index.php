<html lang="en">
	<head>
		<title>Avalon</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<link href="css/codemirror.css" rel="stylesheet">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/codemirror.js"></script>
		<script type="text/javascript" src="js/codemirror_clike.js"></script>
		<style type="text/css">
			.CodeMirror {
				border: 2px inset #dee;
			}
			
			.activeline {
				background: #e8f2ff !important;
			}
			
			.CodeMirror-scroll {
				height: auto;
				overflow-y: hidden;
				overflow-x: auto;
				width: 100%;
			}
		</style>
		<script type="text/javascript">

			$(function() {
				var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
				  mode: "text/x-c++src",
				  lineNumbers: true,
				  lineWrapping: true,
				  matchBrackets: true,
				  onCursorActivity: function() {
					editor.setLineClass(hlLine, null);
					hlLine = editor.setLineClass(editor.getCursor().line, "activeline");
				  },
				  onChange: function(cm) { document.getElementById('code').value = cm.getValue(); }
				});
				var hlLine = editor.setLineClass(0, "activeline");	
			});

			function getCodeForExecution() {
				$('#output').html('<center>Compiling...</center>');
				$.post('php/execute.php', { 
						code: document.getElementById('code').value,
						language: document.getElementById('language').options[document.getElementById('language').selectedIndex].value
					}, function(data) {
					document.getElementById('output').innerHTML = "";
					eval(data);
				});
				return false;
			}

			var Module = {
				print: (function() {
					return function(text) {
						document.getElementById('output').innerHTML += text.replace('\n', '<br>', 'g') + '<br>';
					};
				})(),
			};

		</script>
	</head>
	<body style="padding-top:60px">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand">C on the Web</a>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="span6">
					<h2>Source Code</h2>
					<hr>
					<select id="language" class="span2">
						<option value="c">C</option>
						<option value="cpp">C++</option>
					</select>
					<textarea style="height:600px;" id="code" name="code">
#include <stdio.h>

int main() {
  printf("Hello World!\n");
  return 0;
}

					</textarea>
					<div style="text-align:right;padding-top:5px;">
						<input onclick="getCodeForExecution();" type="submit" class="btn primary" name="Submit" value="Run Code!">
					</div>
				</div>
				<div class="span6">
					<h2>Output</h2>
					<hr>
					<div id="output" style="font-family:Courier;font-size:14px;">
					
					</div>
				</div>
			</div>
		</div>		
	</body>
</html>
