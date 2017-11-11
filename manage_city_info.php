<html>
<?php

    $city_code;
    wp_enqueue_script( 'tinymce','/wp-content/plugins/cityNxt/tinymce/tinymce.min.js');
    wp_enqueue_script( 'tinymce_init','/wp-content/plugins/cityNxt/tinymce/tinymce_init.js');
    wp_enqueue_script( 'prompt','/wp-content/plugins/cityNxt/js/prompt.js');
    wp_enqueue_style( 'styles','/wp-content/plugins/cityNxt/styles/style.css');

    function city_code_form()
    {
        echo'<div id="ccode_form"><form method="post" id="city_code"> 
        Enter City Code: <input type="text" name="city_code" required>
        <input type="hidden" name="state" value="0">
        <input type="submit" value="Submit" onclick="clicked();">
        </form></div>';
    }

    city_code_form();

/*
function city_details_form()
{   
    echo'<form method="post">';
    echo'Selected City Code:<input type="text" name="city_code" value='.$_POST["city_code"].' readonly> <br>';
    echo'<textarea name="city_info"> '.$row["city_info"] .'</textarea>';
    echo'<input type="hidden" name="state" value="1"><br>
    <input type="submit" value="Submit" onclick="clicked1();">
    </form></div>';    
}
*/

function city_info_form()
{
    //echo $_POST['city_code'];
    global $wpdb;
    //$city_code=
    $sql="SELECT * FROM city_nxt WHERE city_code="."'".$_POST["city_code"]."'";
    //echo $sql;
    $row=$wpdb->get_row($sql,ARRAY_A);
    $city_code=$row['city_code'];
    
    /***If city code does not exits***/
    
    if($_POST['city_code']==$row["city_code"])
    {  
        echo'<div class="cinfo_form">';
        //city_details_form();
        
        echo'<form method="post">';

        echo'<table class="wide"><tr><td>Selected City Code</td><td><input type="text" name="city_code" value='.$_POST["city_code"].' readonly></td></tr>';
        
        echo'<tr><td>City Name</td><td><input type="text" name="city_name" value="'.$row["city_name"] .'"></td></tr>';
        echo'</table>';

        echo'<div class="title">Please find latitude and logitude from this <a href="http://www.latlong.net/">link</a></div>';
        echo'<table class="wide"><tr><td>Longitude</td><td><input type="text" name="longit" value="'.$row["longit"] .'"></td>';
        echo'<td>Latitude</td><td><input type="text" name="latit" value="'.$row["latit"] .'"></td></table>';

        echo'<div class="title">Please find weather ID from this <a href="http://woeid.rosselliot.co.nz/">link</a></div>';
        echo'<table class="wide"><tr><td>WOEID </td><td><input type="text" name="woeid" value="'.$row["woeid"] .'"></td></tr></table>';

        echo'<table class="wide"><tr><td>';
        echo'City information</td><td><textarea name="city_info"> '.stripslashes($row["city_info"]) .'</textarea></td></tr></table>';

        echo'<div class="title_tag"><input type="text" name="header" placeholder="Section Heading" value="'.$row["header"] .'"></div>';
        echo'<div class="title_tag"><input type="text" name="sub_header" placeholder="Section SubHeading" value="'.$row["sub_header"] .'"></div>';

        echo'<table class="wide"><tr><td>';
        echo'General text</td><td><textarea name="gen_text"> '.stripslashes($row["gen_text"]) .'</textarea></td></tr></table>';

        echo'<div class="title_tag"><input type="text" name="header2" placeholder="Section Heading" value="'.$row["header2"] .'"></div>';
        echo'<div class="title_tag"><input type="text" name="sub_header2" placeholder="Section SubHeading"value="'.$row["sub_header2"] .'"></div>';

        echo'<table class="wide"><tr><td>';
        echo'General text</td><td><textarea name="gen_text2"> '.stripslashes($row["gen_text2"]) .'</textarea></td></tr></table>';

        echo'<input type="hidden" name="state" value="1"><br>
        <input type="submit" value="Submit" onclick="clicked1();">
        </form></div>';
        
    }
    else
    {
        /***Inserting city code to wpdb****/
        
        $wpdb->insert( 
        'city_nxt', 
        array('city_code' => $_POST["city_code"] ), 
        array('%s') );
        
        //city_details_form();
        /***********************************/
        //$city_code=$_POST["city_code"];

         echo'<form method="post">';

        echo'<table class="wide"><tr><td>Selected City Code</td><td><input type="text" name="city_code" value='.$_POST["city_code"].' readonly></td></tr>';
        
        echo'<tr><td>City Name</td><td><input type="text" name="city_name" required></td></tr>';
        echo'</table>';

        echo'<div class="title">Please find latitude and logitude from this <a href="http://www.latlong.net/">link</a></div>';
        echo'<table class="wide"><tr><td>Longitude</td><td><input type="text" name="longit" required></td>';
        echo'<td>Latitude</td><td><input type="text" name="latit" required></td></table>';

        echo'<div class="title">Please find weather ID from this <a href="http://woeid.rosselliot.co.nz/">link</a></div>';
        echo'<table class="wide"><tr><td>WOEID </td><td><input type="text" name="woeid" required></td></tr></table>';

        echo'<table class="wide"><tr><td>';
        echo'City information</td><td><textarea name="city_info"></textarea></td></tr></table>';

        echo'<div class="title_tag"><input type="text" name="header" placeholder="Section Heading"></div>';
        echo'<div class="title_tag"><input type="text" name="sub_header" placeholder="Section Subheading"></div>';

        echo'<table class="wide"><tr><td>';
        echo'General text</td><td><textarea name="gen_text"></textarea></td></tr></table>';

        echo'<div class="title_tag"><input type="text" name="header2" placeholder="Section Heading"></div>';
        echo'<div class="title_tag"><input type="text" name="sub_header2" placeholder="Section SubHeading"></div>';

        echo'<table class="wide"><tr><td>';
        echo'General text</td><td><textarea name="gen_text2"></textarea></td></tr></table>';
        
        
        echo'<input type="hidden" name="state" value="1"><br>
        <input type="submit" value="Submit" onclick="clicked1();">
        </form>';
        
        
    }
    //echo $row["city_info"];
}

    if($_POST["state"]=="0")
    {
        city_info_form();
    }

    if($_POST["state"]=="1")
    {
        // $row=$wpdb->get_row("SELECT * FROM city_nxt WHERE city_code='DLH'",ARRAY_A);
        global $wpdb;
        //Update city_info to wpdb
        
        
        $wpdb->update( 
        'city_nxt', 
        
        //set statement array    
        array( 
            'city_info' => $_POST["city_info"],	// string
            'city_name' => $_POST["city_name"],
            'latit' => $_POST["latit"],
            'longit' => $_POST["longit"],
            'woeid' => $_POST["woeid"],
            'header' => $_POST["header"],
            'sub_header' => $_POST["sub_header"],
            'gen_text' => $_POST["gen_text"],
            'header2' => $_POST["header2"],
            'sub_header2' => $_POST["sub_header2"],
            'gen_text2' => $_POST["gen_text2"]

        ), 
        
        //where clause array    
        array( 'city_code' => $_POST["city_code"] ), //where city code='selected city code'
        array( 
            '%s',	// city_info
            '%s',	// city_name
            '%s',   // latitude
            '%s',   // longitude
            '%d',   // woeid
            '%s',   //header
            '%s',   //sub_header
            '%s',   //gen_text
            '%s',   //header2
            '%s',   //sub_header2
            '%s'    //gen_text2
        ) 
        //, $format = null
        //, $where_format = null 
        );
        
        echo "<b>Updated..!<b>";
    }
?>
</html>