<!DOCTYPE html>



    <head>

    <title>Cube Gold - Add Gold Button</title>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script type="text/javascript" src="../../../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>

    <script type="text/javascript">



		//More JS Here Later



	</script>

    </head>



    <body>

    <form id="CBAddShortcode">

      <p>

        <label for="AddCBType">Type</label>

        <br />

        <select id="cbselection" name="cb-type">

          <option id="none">Choose...</option>

          <option id="addpoints">Add Points</option>

          <option id="Quest">Quest</option>

          <option id="Paid Content">Paid Content</option>
          <option id="minutes">Minutes</option>

        </select>

        <input type="hidden" id="CBType" />

      </p>

      <p>

        <label for="ButtonDisplay">Button Display <span id="disclaimer">(This will be the button's text):</span></label>

        <br/>

        <input id="ButtonDisplay" type="text" value="" size="45"/>

      </p>
      
     

      <p>

        <label for="StatsPageReason">Gold Reason <span id="disclaimer">(Will be the displayed reason for gold on Stats Page):</span></label>

        <br/>

        <input id="StatsPageReason" type="text" value="" size="45"/>

      </p>

      <p>

        <label for="XP">XP <span id="disclaimer">(Amount of XP given for completion):</span></label>

        <br/>

        <input id="XP" type="text" value="" size="45"/>

      </p>

      <p>

        <label for="Gold">Gold <span id="disclaimer">(Amount of Gold given for completion):</span></label>

        <br/>

        <input id="Gold" type="text" value="" size="45"/>

      </p>
      
       <p>

        <label for="minutes_i">Minutes <span id="disclaimer">:</span></label>

        <br/>

        <input id="minutes_i" type="text" value="" size="45"/>
        <br>
        <label for="minutes_reason">Minutes Reason <span id="disclaimer">(Will be the displayed reason for minutes on Stats Page):</span></label>
        <input id="minutes_reason" type="text" value="" size="45"/>

      </p>

      <script type="text/javascript">



$('#cbselection').change(function(){



   var id = $(this).find(':selected')[0].id;



   $('#CBType').val(id);



})



</script>

      

<style>



#disclaimer {

	color: #444;

	font-size: 9px;

}

</style>

    

      <p><a href="javascript:CBTiny.insert(CBTiny.e)" style="background: #298CBA; text-decoration: none; color: white; float: right; padding: 7px; margin-top: 14px; border-radius: 17px; border: 1px solid lightgray;">Create Shortcode</a></p>

    </form>

</body>

</html><script>



var CBTiny = {



	e: '',



	init: function(e) {



		CBTiny.e = e;



		tinyMCEPopup.resingleimageToInnerSize();



	},



	insert: function createCBAddShortcode(e) {



		//Create gallery Shortcode



		var animatetype = $('#CBType').val();



		var buttondisplay = $('#ButtonDisplay').val();
		
		
	


		var reason = $('#StatsPageReason').val();

		

		var xp = $('#XP').val();



		var gold = $('#Gold').val();
		

			var minutes = $('#minutes_i').val();	
			var minutes_reason = $('#minutes_reason').val();	

		var output = '[add_cubegold ';



		if(animatetype) {



			output += 'type="'+animatetype+'"';



		}



		if(buttondisplay) {



			output += ' button_display="'+buttondisplay+'"';



		}
		
		



		if(reason) {



			output += ' reason="'+reason+'"';



		}

		

		if(xp) {



			output += ' xp="'+xp+'"';



		}

		

		if(gold) {



			output += ' gold="'+gold+'"';



		}



if(minutes) {



			output += ' minutes="'+minutes+'"';



		}



if(minutes_reason) {



			output += ' minutes_reason="'+minutes_reason+'"';



		}



		



		output += ']';



		



		tinyMCEPopup.execCommand('mceReplaceContent', false, output);



		



		tinyMCEPopup.close();



		



	}



}



tinyMCEPopup.onInit.add(CBTiny.init, CBTiny);



</script>