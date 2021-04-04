  <html>
<!--Save this as index.php-->
      <script src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    
     <script type="text/javascript">
    
     $(document).ready(function() {
    
        $("#display").click(function() {                
    
          $.ajax({    //create an ajax request to display.php
            type: "GET",
            url: "display.php",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
                //alert(response);
            }
    
        });
    });
    });
    
    </script>
    
    <body>
    <h3 align="center">Manage  Details</h3>
    <table border="1" align="center">
       <tr>
           <td> <input type="button" id="display" value="Display All Data" /> </td>
       </tr>
    </table>
    <div id="responsecontainer" align="center">
    
    </div>
    </body>
    </html>


