<!doctype html>
<head>
</head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script>
$(document).ready(function(){
  document.getElementById('quan').style.display="none";
})

</script>
<body>
<!-- search box container starts  -->
    <div class="search">
        <h3 class="text-center title-color">Ajax Live Search Table Demo</h3>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="input-group">
                    <span class="input-group-addon" style="color: white; background-color: rgb(124,77,255);">INGREDIENT SEARCH</span>
                    <input type="text" autocomplete="off" id="search" class="form-control input-lg" placeholder="Enter Ingredient Name Here">
                </div>
            </div>
        </div>   
    </div>  
<!-- search box container ends  -->
<div id="txtHint" class="title-color" style="padding-top:50px; text-align:center;" ><b>Ingredient name will be listed here...</b></div>

<div id="quan" class="quan">
  <input type="text" id="quantity" name="quantity" placeholder="Quantity">
  <select name="uom" id="uom">
    <option value="">Measure</option>
    <option value="Teaspoon">Teaspoon</option>
    <option value="Tablespoon">Tablespoon</option>
    <option value="Pinch">Pinch</option>
    <option value="Cup">Cup</option>
    <option value="Pint">Pint</option>
    <option value="Quart">Quart</option>
    <option value="mL">mL</option>
    <option value="Litre">Litre</option>
    <option value="Dash">Dash</option>
  </select>
  <button type="submit">ADD</button>
</div>

</body>
<script>
$(document).ready(function(){
   $("#search").keyup(function(){
       var str=  $("#search").val();
       if(str == "") {
               $( "#txtHint" ).html("<b>Ingredient name will be listed here...</b>"); 
       }else {
               $.get( "{{ url('demos/livesearch?id=') }}"+str, function( data ) {
                   $( "#txtHint" ).html( data );  
            });
       }
   });  
}); 
function adding(){
  document.getElementById("quan").style.display="block";
}
</script>
</html>