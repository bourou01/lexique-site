<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <title>Demo - Covnert JSON to CSV</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="https://github.com/douglascrockford/JSON-js/raw/master/json2.js"></script>
 
    <script type="text/javascript">
        // JSON to CSV Converter
        function ConvertToCSV(objArray) {
            var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
            var str = '';
 
            for (var i = 0; i < array.length; i++) {
                var line = '';
                for (var index in array[i]) {
                    if (line != '') line += ','
 
                    line += array[i][index];
                }
 
                str += line + '\r\n';
            }
 
            return str;
        }
 
        // Example
        $(document).ready(function () {
 
            // Create Object
            var items = [       
                  { name: "Item 1", color: "GrŽen", size: "X-Large" },
                  { name: "Item 2", color: "Grˆen", size: "X-Large" },
                  { name: "Item 3", color: "Gren", size: "X-Large" }];
 
            // Convert Object to JSON
            var jsonObject = JSON.stringify(items);
 
            // Display JSON
            $('#json').text(jsonObject);
 
            // Convert JSON to CSV & Display CSV
            $('#csv').text(ConvertToCSV(jsonObject));
        });
    </script>
</head>
<body>
    <h1>
        JSON</h1>
    <pre id="json"></pre>
    <h1>
        CSV</h1>
    <pre id="csv"></pre>
</body>
</html>