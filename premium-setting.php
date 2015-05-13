<?php
$plugin_dir_url =  plugin_dir_url( __FILE__ );
?>
<style>
.premium-box{ width:100%; height:auto; background:#fff;  }
.premium-features{}
.premium-heading{  color: #484747;font-size: 40px;padding-top: 35px;text-align: center;text-transform: uppercase;}
.premium-features li{ width:100%; float:left;  padding: 80px 0; margin: 0; }
.premium-features li .detail{ width:50%; }
.premium-features li .img-box{ width:50%; }

.premium-features li:nth-child(odd) { background:#f4f4f9; }
.premium-features li:nth-child(odd) .detail{float:right; text-align:left; }
.premium-features li:nth-child(odd) .detail .inner-detail{}
.premium-features li:nth-child(odd) .detail p{ }
.premium-features li:nth-child(odd) .img-box{ float:left; text-align:right;}

.premium-features li:nth-child(even){  }
.premium-features li:nth-child(even) .detail{ float:left; text-align:right;}
.premium-features li:nth-child(even) .detail .inner-detail{ margin-right: 46px;}
.premium-features li:nth-child(even) .detail p{ float:right;} 
.premium-features li:nth-child(even) .img-box{ float:right;}

.premium-features .detail{}
.premium-features .detail h2{ color: #484747;  font-size: 24px; font-weight: 700; padding: 0;}
.premium-features .detail p{  color: #484747;  font-size: 13px;  max-width: 327px;}
/**images**/
.pincode-check{ background:url(<?php echo $plugin_dir_url; ?>assets/img/change-img.jpg); width:507px; height:248px; display:inline-block; margin-right: 25px; background-repeat:no-repeat;}

.sat-sun-off{ background:url(<?php echo $plugin_dir_url; ?>assets/img/saturday-sunday-off.jpg); width:500px; height:161px; display:inline-block; background-size:500px auto; margin-right:30px; background-repeat:no-repeat;}

.bulk-upload{ background:url(<?php echo $plugin_dir_url; ?>assets/img/bulk-csv-uploads.jpg); width:364px; height:275px; display:inline-block; background-repeat:no-repeat;}

.cod-verify{background:url(<?php echo $plugin_dir_url; ?>assets/img/cod-check.jpg); width:469px; height:167px; display:inline-block; margin-right:30px; background-repeat:no-repeat;}

.delivery-date{background:url(<?php echo $plugin_dir_url; ?>assets/img/delivery-date.jpg); width:490px; height:199px; display:inline-block; background-repeat:no-repeat;}

.advance-styling{background:url(<?php echo $plugin_dir_url; ?>assets/img/style-check.jpg); width:440px; height:335px; display:inline-block; margin-right:30px; background-repeat:no-repeat;}

.Checkout-Page-Pincode--Check{background:url(<?php echo $plugin_dir_url; ?>assets/img/Checkout-Page-Pincode-Check.jpg); width:488px; height:260px; display:inline-block; background-repeat:no-repeat;}

/*upgrade css*/

.upgrade{background:#f4f4f9;padding: 50px 0; width:100%; clear: both;}
.upgrade .upgrade-box{ background-color: #808a97;
    color: #fff;
    margin: 0 auto;
   min-height: 110px;
    position: relative;
    width: 60%;}

.upgrade .upgrade-box p{ font-size: 15px;
     padding: 19px 20px;
    text-align: center;}

.upgrade .upgrade-box a{background: none repeat scroll 0 0 #6cab3d;
    border-color: #ff643f;
    color: #fff;
    display: inline-block;
    font-size: 17px;
    left: 50%;
    margin-left: -150px;
    outline: medium none;
    padding: 11px 6px;
    position: absolute;
    text-align: center;
    text-decoration: none;
    top: 36%;
    width: 277px;}

.upgrade .upgrade-box a:hover{background: none repeat scroll 0 0 #72b93c;}

.premium-vr{ text-transform:capitalize;} 

</style>







<div class="premium-box">


<div class="upgrade">
<div class="upgrade-box">
<!--<p> Switch to the premium version of Woocommerce Check Pincode/Zipcode for Shipping and COD to get the benefit of all features! </p>
--><a target="_blank" href="http://www.phoeniixx.com/product/woocommerce-check-pincodezipcode-for-shipping-and-cod/"><b>UPGRADE</b> to the <span class="premium-vr">premium version</span></a>

</div>
</div>

<ul class="premium-features">
<h1 class="premium-heading">Premium Features</h1>
<li>

<div class="img-box"><span class="pincode-check"></span></div>

 <div class="detail">
 <div class="inner-detail">
   <h2>Add to Cart Activation based on Pincodes</h2>
    <p>
       The Add to Cart Button won&acute;t work unless the Pincode that the user has entered is available for delivery as per your list of available pin codes.
    </p>
  </div> 
</li>


<li>
 <div class="detail">
  <div class="inner-detail">
   <h2>Saturday/Sunday Off Option</h2>
    <p>
      You have the option to activate or deactivate the Saturday/Sunday off option to ensure that no delivery dates are set for Saturdays or Sundays.
    </p>
   </div> 
 </div>
 <div class="img-box"><span class="sat-sun-off"></span></div>
</li>


<li>
<div class="img-box"><span class="bulk-upload"></span></div>

 <div class="detail">
 <div class="inner-detail">
   <h2>Bulk CSV Uploads</h2>
    <p>
       With bulk CSV uploads option you can enter as many pin codes as you want into the system in one go. There will be no need to manually add each Pin Code.
    </p>
  </div> 
</li>


<li>
 <div class="detail">
  <div class="inner-detail">
   <h2>COD Verification</h2>
    <p>
      You have the option to choose which pin codes will support the  COD option and which pin codes won&acute;t.
    </p>
   </div> 
 </div>
 <div class="img-box"><span class="cod-verify"></span></div>
</li>

<li>

<div class="img-box"><span class="delivery-date"></span></div>

 <div class="detail">
 <div class="inner-detail">
   <h2>Delivery Dates Preview</h2>
    <p>
       The delivery date for the pincodes chosen by the user will appear on the Product Page, Cart Page and even the Checkout Page.
    </p>
  </div> 
  </div>
</li>


<li>
 <div class="detail">
  <div class="inner-detail">
   <h2>Advanced Styling Options</h2>
    <p>
     You will get access to many advanced styling options to create a Check Pin Code format that will gel completely with your website.
    </p>
   </div> 
 </div>
 <div class="img-box"><span class="advance-styling"></span></div>
</li>


<li>
 <div class="detail">
  <div class="inner-detail">
   <h2>Checkout Page Pincode Check</h2>
    <p>
      Usually customers enter a different pincode on Checkout page and process their order. But with this feature the Customer cannot enter a different Pincode in the checkout step of the order process as the Pincodes will be checked on Checkout Page also
    </p>
   </div> 
 </div>
 <div class="img-box"><span class="Checkout-Page-Pincode--Check"></span></div>
</li>




</ul>

<div class="upgrade">
<div class="upgrade-box">
<!--<p> Switch to the premium version of Woocommerce Check Pincode/Zipcode for Shipping and COD to get the benefit of all features! </p>
--><a target="_blank" href="http://www.phoeniixx.com/product/woocommerce-check-pincodezipcode-for-shipping-and-cod/"><b>UPGRADE</b> to the <span class="premium-vr">premium version</span></a>
</div>

</div>


</div>

