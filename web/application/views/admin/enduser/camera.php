<style type="text/css">
   
    .img {
        background: #ffffff;
        padding: 12px;
        border: 1px solid #999999;
    }

    .shiva {
        -moz-user-select: none;
        background: #2A49A5;
        border: 1px solid #082783;
        box-shadow: 0 1px #4C6BC7 inset;
        color: white;
        padding: 3px 5px;
        text-decoration: none;
        text-shadow: 0 -1px 0 #082783;
        font: 12px Verdana, sans-serif;
    }
</style>




    <div id="main" style="height:800px; width:100%">
        <div id="content" style="float:left; width:240px; margin-left:20px; margin-top:20px;" align="center">

            <script type="text/javascript" src="<?php echo base_url();?>assets/js/cam/webcam.js"></script>
            <script language="JavaScript">
                document.write(webcam.get_html(240, 140));
            </script>
            <form>
                <br />
                <input type=button value="Configure settings" onClick="webcam.configure()" class="shiva"> &nbsp;&nbsp;
                <input type=button value="snap" onClick="take_snapshot()" class="shiva">
				
            </form>
        </div>

        <script type="text/javascript"> 
            webcam.set_api_url('<?php echo base_url('admin/enduser/saveImage');?>');
            webcam.set_quality(90);  
            webcam.set_shutter_sound(true);
            webcam.set_hook('onComplete', 'my_completion_handler');

            function take_snapshot() {
                document.getElementById('img').innerHTML = '<h1>Uploading...</h1>';
                webcam.snap();
            }

            function my_completion_handler(msg) {
                if (msg.match(/(http\:\/\/\S+)/)) {
                    document.getElementById('img').innerHTML = '<h3>Upload Successfuly done</h3>' + msg;

                    document.getElementById('img').innerHTML = "<img src=" + msg + " class=\"img\">";
					
					//window.opener.document.getElementById("snap").value = msg;
					window.document.getElementById("snapp").value = msg;
					
                    webcam.reset();
				
					
                } else {
                    alert("Error occured we are trying to fix now: " + msg);
                }
				
            }
			
			
        </script>
        <form class="form-horizontal" action="<?php echo base_url('admin/enduser/saveSnap');?>" id="edit_page" name="edit_page"  method="post" autocomplete="off">
        <div id="img" style=" height:140px; width:240px; float:right; margin-right:50px; margin-top:20px;">
		
        </div><br/><br/><br/>
		<input type="hidden" name="snapp" id="snapp" value="">
		<button type="submit" style="float:right; margin-top:170px;" name='snapp_img'  value='OK' class="btn green btn-primary glyphicons circle_ok"><i></i>Save</button>
		
		</form>
    </div>
