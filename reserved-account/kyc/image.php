<div class="container flexbox">
    <div class="section">
                  <!-- Form with placeholder -->
                  <div class="row col s6 m12 l6 custom-form-control ">
                    <div class="card-panel  hoverable">
			<div class="row flex-items-sm-center justify-content-center">  
				<div class="col s12 align-middle text-center">
					 
				<form class="row py-1 flex-items-sm-center justify-content-center" onsubmit="return ajaxRequest(this,'process/image_upload.php');" enctype="multipart/form-data">
				 <center>
                                      <div class="input-field col s12">
                                      <select <?php if($kycVerified){ echo "disabled";}?> required required name="cardType">
                                          <option>Card Type</option>
                                          <option <?php echo $kyc["card_type"]=="National ID Card"? "selected": ""; ?>>National ID Card</option>
                                          <option <?php echo $kyc["card_type"]=="Voter's Card"? "selected": ""; ?> >Voter's Card</option>
                                          <option <?php echo $kyc["card_type"]=="International ID Card"? "selected": ""; ?> >International ID Card</option>
                                          <option <?php echo $kyc["card_type"]=="Driver's License"? "selected": ""; ?> >Driver's License</option>
                                      </select>
                                      </div>
                                       <div class="input-field col s12">
					     <input <?php if($kycVerified){ echo "disabled";}?>  id="planDisplayName"  required name="cardNumber" type="text" value="<?php echo $kyc['card_number']; ?>">
				             <label for="cardNumber">Card Number</label>
					</div>
				  <label style=" height:200px;  <?php if($kycVerified){ echo "disabled";}?> display:inline-block;" class="col s12 card-panel  rounded border text-center w-50 h-25" id="scrn">
                                      <div>
                                      				
							<input <?php if($kycVerified){ echo "disabled";}?> style="display:none" required onchange="readURL(this)" class="" accept="image/gif, image/jpeg, image/png" hidden id="imag" type="file" name="fileToUpload" id="fileToUpload">
					
                                                        <h5 class="valign" style=" background: rgba(0,0,0,.8)" id="select-image"><?php echo $LANG["please_select_an_image"];?></h5>
                                      </div>
                                  </label>
                                     
					</center>
                           
                         <div class="col s12 left-align">
                          <div class="switch left">
                               <label>
                                    
                                 <input  <?php if($kycVerified){ echo "disabled";}?> <?php if($kyc["submitted"] == '1'){echo 'checked';}?> id="submit" value="1" type="checkbox" name="submitted">
                                <span class="lever"></span>
                                Submit KYC for approval now
                               </label>
                         </div>
                         </div>
				
				  <div class="col s12">
				           <center> <button <?php if($kycVerified){ echo "disabled";}?> class="btn right waves-effect waves-light" type="submit" name="image"><i class="material-icons">cloud_upload</i></button></center>
					</div>
			
				 </form>
				  </div>
				  </div>
                            
				 </section>

    </body>
    </html>
		<script>
		function getImage(){
		var imag = document.getElementById("select-image").innerHTML;
		alert(imag);
		var scrn = document.getElementById('scrn');
		scrn.style.backgroundImage = "url("+ imag +")";
		}



function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
					document.getElementById("select-image").innerHTML = "";;
					var imag = document.getElementById("imag").value;
					var scrn = document.getElementById('scrn');
					if(imag==""){
					document.getElementById("select-image").innerHTML ="Please Select an Image"
					}
					scrn.style.backgroundImage = "url("+ e.target.result +")";
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("scrn").style.backgroundImage = "url('card/<?php echo $kyc["card_path"]?>')";
   
</script>
 <style>
 #scrn{
 background-repeat: no-repeat;
 background-size:cover;
 }
 </style>
 
 
 
  
 
 </div>
 </div>
 
 