<script src="js/jquery-2.2.2.min.js"></script>

<script>
	function js( num){
		var doc1 = "<tr><td>";
		var doc2 = "</td></tr>";
		varc = doc1+num;
		varc = varc+doc2;

		document.write(varc);
	}
</script>

<table>
	<script>
		for(var idx=0; idx<30; idx++){
		js(idx);	
		}
		
	</script>

</table>






<html>
    <head>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
            $('#navigation li').live('click', function() {
                $('#navigation li').removeClass('selected');
                $(this).addClass('selected');
            })
        </script>
        <style type="text/css">
            #navigation li {
                list-style:none;
                float:left;
                padding:5px;
            }
            #navigation {
                cursor:pointer;
            }
            #navigation .selected {
                background-color:red;
                color:white;
            }
        </style>
    </head>
    <body>
        <ul id="navigation">
            <li>HTML</li>
            <li>CSS</li>
            <li>javascript</li>
            <li class="selected">jQuery</li>
            <li>PHP</li>
            <li>mysql</li>
        </ul>
    </body>
</html>
