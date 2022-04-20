<div class="sidebar-navigation nmnm">
<div class="title">Request Catalogue</div>
	<div class="row">
        <?php echo e(Form::open([
          'id'=>'contactUsPage',
          'class'=>'FromSubmit',
          'url'=>route('front.contact_us.store'),
          'data-redirect_url'=>url()->full(),
          'name'=>'contactus',
          'enctype'           =>"multipart/form-data"
          ])); ?>

            <div class="Contact-us">
                <div class="form-input col-md-12">
                    <input type="text" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-input col-md-12">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-input col-md-12">
                    <input type="text" name="phone" placeholder="Phone">
                </div>
                <div class="form-input col-md-12">
                    <input type="text" name="company_name" placeholder="Company Name">
                </div>
                <div class="form-input col-md-12">
                  <input type="text" name="message" placeholder="Address">
                </div>
            </div>
            <div class="form-submit col-md-12 text_ce">
	            <button type="submit" class="btn btn-primary btn-custom-6">Request</button>
	        </div>
        <?php echo e(Form::close()); ?>


    </div>
</div><?php /**PATH /var/www/html/makeupnoor/resources/views/front/common/_request_catalog.blade.php ENDPATH**/ ?>