<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snowlake Hubspot Webhook</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  
  <!-- CodeMirror CSS & JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/sql/sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/show-hint.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/sql-hint.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/show-hint.min.css">
    
    <style>
        .CodeMirror {
            border: 1px solid #ced4da;
            height: 200px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
	
</head>
<body class="container mt-4">
	<div class="container mt-2">
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#connModal">
			Create Connection
		</button>
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#instrModal">
			Query Instructions
		</button>
	</div>
	<?php include "create-connection.php"; ?>
	<?php include "query-instructions.php"; ?>
	<div class="container mt-4"  id="sql-editor" style="display: none;">
		<h2 class="mt-2">Query Editor</h2>
		<textarea id="queryInput" class="form-control" rows="4" placeholder="Enter your query..." ></textarea>
		<button class="btn btn-primary mt-2" onClick="runQuery()">Run Query</button>
		<div class="table-responsive" id="snowflake-response" style="display: none;">
			<h3 class="mt-4">Results</h3>
			<button class="btn btn-success mt-2"onClick="publish()">Publish Hubspot</button>
			<table class="table table-striped display" id="dataTable" width="100%">
				<thead id="tableHead">
					<tr></tr>
				</thead>
				<tbody id="tableBody"></tbody>
			</table>
		</div> 	
	</div>

    <script>
	
        function runQuery() {
			//let data; // Variable to store the response
            //const query = document.getElementById("queryInput").value;	
            const query = editor.getValue();			
			//let data; // Variable to store the response
            const user = document.getElementById("sn-usr").value;
			const pass = document.getElementById("sn-pwd").value;
			//alert(query);
			$.ajax({
					url: "server.php",  // Change to your backend URL
                    type: "POST",        // Can be "POST" or "GET"
                    data: { query: query, qType:"select", user: user, pswd:pass }, // Example of sending data
					dataType: "json",
                    success: function(data) {
						const tableHead = document.getElementById("tableHead");
						const tableBody = document.getElementById("tableBody");
						tableHead.innerHTML = "<tr></tr>";
						tableBody.innerHTML = "";
						
						if (data.length === 0) return;
						
						// Populate table headers
						const headers = Object.keys(data[0]);
						const headerRow = tableHead.querySelector("tr");
						headers.forEach(header => {
							const th = document.createElement("th");
							th.textContent = header;
							headerRow.appendChild(th);
						});
						
						// Populate table rows
						data.forEach(row => {
							const tr = document.createElement("tr");
							headers.forEach(header => {
								const td = document.createElement("td");
								td.textContent = row[header];
								tr.appendChild(td);
							});
							tableBody.appendChild(tr);
						})
						document.getElementById("snowflake-response").style.display = "block";
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + " - " + error);
                    }
                });			
		           
        }
		
        function publish() {
			//let data; // Variable to store the response
            //const query = document.getElementById("queryInput").value;
			const query = editor.getValue();			
			const user = document.getElementById("sn-usr").value;
			const pass = document.getElementById("sn-pwd").value;
			$.ajax({
					url: "server.php",  // Change to your backend URL
                    type: "POST",        // Can be "POST" or "GET"
                    data: { query: query, qType:"publish", user: user, pswd:pass }, // Example of sending data
					//dataType: "json",
                    success: function(response) {
						alert(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + " - " + error);
                    }
                });				           
        }
		
		function testConnection(data) {
			//let data; // Variable to store the response
            //const user = document.getElementById("sn-usr").value;
			//const pass = document.getElementById("sn-pwd").value;
			
			$.ajax({
					url: "sn-config.php",  // Change to your backend URL
                    type: "POST",        // Can be "POST" or "GET"
                    //data: { user: user, pswd:pass }, // Example of sending data
					data: data, // Example of sending data
					dataType: "json",
                    success: function(response) {
						//document.getElementById("test-response").innerHTML = response.msg;
						alert(response.msg);
						document.getElementById("sql-editor").style.display = "block";
                    },
                    error: function(xhr, status, error) {
                        alert("AJAX Error: " + status + " - " + error);
                    }
                });				           
        }
		
		function updateaccesstoken() {
			//let data; // Variable to store the response
            const user = document.getElementById("sn-usr").value;
			const token = document.getElementById("updatetoken").value;
			
			$.ajax({
					url: "hb-config.php",  // Change to your backend URL
                    type: "POST",        // Can be "POST" or "GET"
                    data: { user: user, token:token }, // Example of sending data
					//data: data, // Example of sending data
					dataType: "json",
                    success: function(response) {
						//document.getElementById("test-response").innerHTML = response.msg;
						alert(response.msg);
						//document.getElementById("sql-editor").style.display = "block";
                    },
                    error: function(xhr, status, error) {
                        alert("AJAX Error: " + status + " - " + error);
                    }
                });				           
        }
		
		
		$("#connectionform").submit(function(event) {
                event.preventDefault(); // Prevent default form submission
				const data =  $(this).serialize();																			
				testConnection(data);
				
		});
		
		var editor = CodeMirror.fromTextArea(document.getElementById("queryInput"), {
        mode: "text/x-sql",
        theme: "default",
        //lineNumbers: true,
        matchBrackets: true,
        autoCloseBrackets: true,
        extraKeys: {"Ctrl-Space": "autocomplete"},
    });
		
    </script>
</body>
</html>
