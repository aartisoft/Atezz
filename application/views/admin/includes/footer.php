                <footer class="footer text-right">
                  &copy; <?php echo date('Y'); ?> <div class="version">Version <?php echo $this->session->userdata('version');?></div>
                </footer>

            </div>
        </div>
    	<script>var resizefunc = []; </script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.js"></script> 
		<script>
            var BASE_URL = "<?php echo base_url(); ?>";     
			$("[name='my-checkbox']").bootstrapSwitch();      
        </script>
        <script>setTimeout(function(){ $('#flash_succ_message').hide(); }, 5000);</script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrapValidator.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/admin_validation.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
		<!-- REQUIRED FOR FETCHING USER TIME ZONE -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jstz-1.0.4.min.js"></script>   
		<script type="text/javascript">
			$(document).ready(function() {
				var tz = jstz.determine();
				var timezone = tz.name();
				$.post('<?php echo base_url(); ?>ajax',{timezone:timezone},function(res){
				// console.log(res);
				})      
			});
		</script>
		<script>
 function subitmorefield()
 {
	var labe=$("#field-1").val();
	var fname= $("#field-2").val();
    var html=''; 
	var html = '<div class="form-group">';
      html = html+' <label class="col-sm-3 control-label">'+labe+'</label>';
	  html = html+' <div class="col-sm-9">'; 
	  html = html+'<input type="text" class="form-control"  name="'+fname+'" placeholder="Type here.." value=""'; 
	  html = html+'</div>';
	  html = html+'</div>';
    $('.hrs_detail_addmore').append(html);
  	$('#con-close-modal').modal('hide');
 }
 </script>
<script>
function fnc(value, min, max) 
{
    if(parseInt(value) < 0 || isNaN(value)) 
        return 0; 
    else if(parseInt(value) > 50) 
        return 1; 
    else return value;
}
</script>
 <script>
    // jQuery ".Class" SELECTOR.
    $(document).ready(function() {
		
        $('.numberonly').keypress(function (event) {
            return isNumber(event, this)
        });
    });
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }    
</script>
	</body>
</html>