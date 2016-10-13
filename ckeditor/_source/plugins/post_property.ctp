<?php if(isset($pageVar) && is_array($pageVar)) extract($pageVar) ?>


<script>
	jQuery(document).ready(function(){
		//alert("123");
		 jQuery("#formID").validationEngine('attach', {promptPosition : "centerRight"});
		 jQuery("#formID1").validationEngine('attach', {promptPosition : "centerRight"});    

	});
	


  $(function(){
     
      $("#state").change(function(){      
      $.ajax({
        url:"<?php echo SITE_URL."locations/get_location_list3/";?>"+$("#state").val(),       
        type: 'GET',
        dataType: 'HTML',
        success: function (data) {
          //alert(data);
           $('#location').html(data);
        },
           error: function (xhr, status) {
              switch (status) {
                 case 404:
                     alert('File not found');
                     break;
                 case 500:
                     alert('Server error');
                     break;
                 case 0:
                     alert('Request aborted');
                     break;
                 default:
                     alert('Unknown error ' + status);
             } 
         }
    });
     
   // alert('url');
  });

   

});

</script> 
<?php
  
  $list_propertytype = $this->requestAction('/properties/get_propertytype_list/');
  $propertytype_list = array();
  foreach($list_propertytype as $propertytype)
  {
    $propertytype_list[$propertytype['PropertyType']['id']] = $propertytype['PropertyType']['title'];
  }


  $list_state = $this->requestAction('/properties/get_state_list/');
  $state_list = "";
  foreach($list_state as $state)
  {
    $state_list[$state['State']['id']] = $state['State']['title'];
  }



//get the location
$list_location = $this->requestAction('/locations/get_location_list2/1');
$location_list = array();
foreach($list_location as $location)
{
  $location_list[$location['Location']['id']] = $location['Location']['title'];
}

$facinglist = array();
  $facinglist[''] = "Select Property Facing";
  $facinglist[1] = "North";
  $facinglist[2] = "South";
  $facinglist[3] = "East";
  $facinglist[4] = "West";
  $facinglist[5] = "South East";
  $facinglist[6] = "South West";
  $facinglist[7] = "North East";
  $facinglist[8] = "North West";


  $propertyFor = array();
 
  $propertyFor[1] = "Sale";
  $propertyFor[2] = "Rent"; 


  $ageOfConstruction = array();

  $ageOfConstruction[''] = "Select";
  $ageOfConstruction[1] = "1 Year";
  $ageOfConstruction[2] = "2 Year";
  $ageOfConstruction[3] = "3 year";
  $ageOfConstruction[4] = "4 Year";
  $ageOfConstruction[5] = "5 Year";
  $ageOfConstruction[6] = "6 Year";
  $ageOfConstruction[7] = "7 Year";
  $ageOfConstruction[8] = "8 Year";
  $ageOfConstruction[9] = "9 Year";
  $ageOfConstruction[10] = "10 Year";
  $ageOfConstruction[11] = "> 10 Year";



?> 



<section class="main">
  <div class="wrapper">
    <div class="row">
      <div class="success_msg">   <?php if($this->Session->check('Message.flash')): ?>
        <?php  echo $this->Session->flash(); ?>
      <?php endif;?>
      </div>
    <div class="registerbox">   
      
       
      <h1>POST Your Property </h1>
      <?php echo $this->Form->create('Property',array('id'=>'formID','enctype'=>'multipart/form-data','class'=> 'form-horizontal')); ?>
      
      <input type="hidden" name="form_type" value="owner" />
     
       
         <div class="form-group">
          <label for="firstName" class="col-sm-4 control-label">First Name<span>*</span></label>
          <div class="col-sm-8">
            <?php echo $this->Form->input('Owner.firstname',array('class'=>'validate[required], form-control','value'=>'','label'=>false, 'id'=>'firstName', 'placeholder'=>'Enter First Name'));?>         
          </div>
        </div>  
        <div class="form-group">
          <label for="lastName" class="col-sm-4 control-label">Last Name<span>*</span></label>
          <div class="col-sm-8">
            <?php echo $this->Form->input('Owner.lastname',array('class'=>'validate[required] , form-control','value'=>'','label'=>false, 'id'=>'lastName', 'placeholder'=>'Enter Last Name'));?>          
          </div>
        </div>
         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Phone</label>
          <div class="col-sm-8">
          <div class="input-group">
            <?php echo $this->Form->input('Owner.phone',array('class'=>'validate[custom[phone], form-control','value'=>'','label'=>false, 'id'=>'phone', 'placeholder'=>'Enter Mobile No'));?>  
            <div class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></div>
          </div>          
          </div>
        </div>

        <!-- post property fields -->
        <div class="form-group">
          <label for="" class="col-sm-4 control-label">Property Name</label>
          <div class="col-sm-8">         
            <?php echo $this->Form->input('Property.name',array('class'=>'form-control validate[required] page_tit','label'=>false));?>                    
          </div>
        </div>

         <div class="form-group">
          <label for="state" class="col-sm-4 control-label">Property For<span>*</span></label>
          <div class="col-sm-8">
             <?php
                echo $this->Form->input('Property.property_for', array('type' => 'select',
                  'id' => 'property_for',
                  'label'=>false,
                  'value'=>'all',
                  'class'=>'form-control',
                  'options' => $propertyFor,
                  'legend'=>false,
                ));?>
                      
          </div>
        </div> 

        <div class="form-group">
          <label for="state" class="col-sm-4 control-label">State<span>*</span></label>
          <div class="col-sm-8">
             <?php
                echo $this->Form->input('Property.state', array('type' => 'select',
                  'id' => 'state',
                  'label'=>false,
                  'value'=>'all',
                  'class'=>'form-control',
                  'options' => $state_list,
                  'legend'=>false,
                ));?>
                      
          </div>
        </div>  
       
         <div class="form-group">
          <label for="city" class="col-sm-4 control-label">Location / City<span>*</span></label>
          <div class="col-sm-8">
             <?php
          echo $this->Form->input('Property.location', array('type' => 'select',
              'id' => 'location',
              'label'=>false,
              'value'=>'all',
              'class'=>'form-control validate[required]',
              'options' => $location_list,
              'legend'=>false,
                         ));
                 ?>         
          </div>
        </div>  
          <div class="form-group">
          <label for="city" class="col-sm-4 control-label">Property Type<span>*</span></label>
          <div class="col-sm-8">
             <?php
           echo $this->Form->input('Property.property_type', array('type' => 'select',
              'id' => 'propertytype',
              'label'=>false,
              'value'=>'all',
              'class'=>'form-control validate[required]',
              'options' => $propertytype_list,
              'legend'=>false,
                         ));
                 ?>         
          </div>
        </div>  

         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Property Address</label>
          <div class="col-sm-8">         
            <?php echo $this->Form->textarea('Property.address',array('class'=>'form-control validate[required] ','label'=>false));?>                    
          </div>
        </div>

         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Zip Code<span> * </span></label>
          <div class="col-sm-8">         
            <?php echo $this->Form->input('Property.zip',array('class'=>'form-control validate[required], custom[integer]','label'=>false));?>                    
          </div>
        </div>

         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Bedrooms<span> * </span></label>
          <div class="col-sm-8">         
            <?php echo $this->Form->input('Property.bedroom',array('class'=>'form-control validate[required],custom[integer]','label'=>false, 'placeholder'=>''));?>                    
          </div>
        </div>

         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Total No. of Rooms<span> * </span></label>
          <div class="col-sm-8">         
            <?php echo $this->Form->input('Property.totalroom',array('class'=>'form-control validate[required],custom[integer]','label'=>false, 'placeholder'=>''));?>                    
          </div>
        </div>
         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Attached Bathrooms<span> * </span></label>
          <div class="col-sm-8">         
            <?php echo $this->Form->input('Property.attachedbathroom',array('class'=>'form-control validate[required],custom[integer]','label'=>false, 'placeholder'=>''));?>                    
          </div>
        </div>
         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Common Bathrooms<span> * </span></label>
          <div class="col-sm-8">         
            <?php echo $this->Form->input('Property.commonroom',array('class'=>'form-control validate[required],custom[integer]','label'=>false, 'placeholder'=>''));?>                    
          </div>
        </div>

         <!-- <div class="form-group">
          <label for="lastName" class="col-sm-4 control-label">Area (Space)<span>*</span></label>
          <div class="col-sm-8">
         
           <?php echo $this->Form->input('Property.area',array('type'=>'text','class'=>'form-control validate[required,custom[integer]]','label'=>false));?>
                     
          </div>
        </div> -->

         <div class="form-group">
          <label for="" class="col-sm-4 control-label">No.of Floors<span> * </span></label>
          <div class="col-sm-8">         
            <?php echo $this->Form->input('Property.floors',array('class'=>'form-control validate[required],custom[integer]','label'=>false, 'placeholder'=>''));?>                    
          </div>
        </div>
         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Flooring<span> * </span></label>
          <div class="col-sm-8">         
            <?php echo $this->Form->input('Property.flooring',array('class'=>'form-control validate[required]','label'=>false, 'placeholder'=>''));?>                    
          </div>
        </div>
         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Parking Facility<span> * </span></label>
          <div class="col-sm-8">         
            <?php echo $this->Form->input('Property.parkingfacility',array('class'=>'form-control validate[required]','label'=>false, 'placeholder'=>''));?>                    
          </div>
        </div>
         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Age of Constuction<span> * </span></label>
          
           <div class="col-sm-8">
             <?php
                echo $this->Form->input('Property.age', array('type' => 'select',
                  'id' => 'age',
                  'label'=>false,
                  'value'=>'all',
                  'class'=>'form-control',
                  'options' => $ageOfConstruction,
                  'legend'=>false,
                ));?>
                      
          </div>
        </div>

        
          <div class="form-group">
          <label for="country" class="col-sm-4 control-label">Property Facing<span>*</span></label>
          <div class="col-sm-8">
            <?php 
             echo $this->Form->input('propertyfacing', array('type' => 'select',
                      'id' => 'propertyfacing',
                      'label'=>false,
                      'value'=>'',
                      'class'=>'form-control , validate[required]',
                      'options' => $facinglist,
                      'legend'=>false,
                                 ));
                         ?>
                
          </div>
        </div> 

        <div class="form-group">
          <label for="" class="col-sm-4 control-label">Property Area(Sq Feet)<span> * </span></label>
          <div class="col-sm-8">         
            <?php echo $this->Form->input('Property.propertyarea',array('class'=>'form-control validate[custom[integer]]','label'=>false, 'placeholder'=>'area in sq ft'));?>                    
          </div>
        </div>

         <div class="form-group">
          <label for="" class="col-sm-4 control-label">Short Description<span>*</span></label>
          <div class="col-sm-8">
         
           <?php echo $this->Form->textarea('Property.short_description',array('class'=>'form-control validate[required] page_tit','label'=>false));?>                   
          </div>
        </div>   
       

         <div class="form-group">
          <label for="postal" class="col-sm-4 control-label">Price<span>*</span></label>
          <div class="col-sm-8">
           <?php echo $this->Form->input('Property.rentals',array('type'=>'text','class'=>'form-control  validate[required,custom[integer]] ','label'=>false,'placeholder'=>'Price'));              
              ?>      
          </div>
        </div>  

        <div class="form-group">
          <label for="postal" class="col-sm-4 control-label">Main Image: <span>*</span></label>
          <div class="col-sm-8">
           <?php echo $this->Form->input('main_image',array('class'=>'validate[custom[onlyImagesAllowed]]','type'=>'file','id'=>'main_image','label'=>false));?>
          </div>
        </div>

         <div class="form-group">
          <label for="email" class="col-sm-4 control-label">Email<span>*</span></label>
          <div class="col-sm-8">
          <div class="input-group">
            <?php echo $this->Form->input('Owner.email',array('class'=>'validate[required,custom[email]], form-control','value'=>'','label'=>false ,'id'=>'email', 'placeholder'=>'Email'));?>
            <div class="input-group-addon">@</div>
            </div>
       
          </div>
        </div>

        <div class="form-group">
          <label for="password" class="col-sm-4 control-label">Password<span>*</span></label>
          <div class="col-sm-8">
           <div class="input-group">
            <?php echo $this->Form->input('Owner.password',array('class'=>'form-control validate[required]','value'=>'','id'=>'password','label'=>false, 'placeholder'=> "Password"));?>
          <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
          </div>              
          </div>
        </div>  

          
       
           
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" class="btn btn-success">Post Property</button>
          </div>
        </div>
        <?php echo $this->Form->end(); ?> 
              </div>

            </div>
          </div>


        </div>
      </section>
