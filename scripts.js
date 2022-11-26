
function fill(Value) {
//Assigning value to "search" div in "search.php" file.
$('#search').val(Value);
//Hiding "display" div in "search.php" file.
$('#display').hide();
}
$(document).ready(function() {
//On pressing a key on "Search box" in "search.php" file. This function will be called.
$("#search").keyup(function() {
    //Assigning search box value to javascript variable named as "name".
    var name = $('#search').val();
    //Validating, if "name" is empty.
    if (name == "") {
        //Assigning empty value to "display" div in "search.php" file.
        $("#display").html("");
    }
    //If name is not empty.
    else {
        //AJAX is called.
        $.ajax({
            //AJAX type is "Post".
            type: "POST",
            //Data will be sent to "ajax.php".
            url: "welcome.php",
            //Data, that will be sent to "ajax.php".
            data: {
                //Assigning value of "name" into "search" variable.
                search: name
            },
            //If result found, this funtion will be called.
            success: function() {
                //Assigning result to "display" div in "search.php" file.
                $("#display").html().show();
            }
        });
    }
});
});

function showResult(str) {
    if (str.length==0) {
      document.getElementById("livesearch").innerHTML="";
      document.getElementById("livesearch").style.border="0px";
      return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("livesearch").innerHTML=this.responseText;
        document.getElementById("livesearch").style.border="1px solid #A5ACB2";
      }
    }
    xmlhttp.open("GET","livesearch.php?q="+str,true);
    xmlhttp.send();
  }
