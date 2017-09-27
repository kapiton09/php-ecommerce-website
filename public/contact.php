<!-- Configuration-->

<?php require_once("../resources/config.php"); ?>

<!-- Header-->
<?php include(TEMPLATE_FRONT .  "/header.php");?>

         <!-- Contact Section -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted">
                        <?php display_message(); ?>
                    </h3>
                </div>
                <div class="col-lg-12 text-center">
                    <h3>You can either call us, email us or visit us by the information provided below.</h3>
                    <hr class="dl-horizontal" />
                    <div class="col-md-12">
                        <div class="row">
                            <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                            <label>(09)-555 0255</label>
                        </div>
                        <div class="row">
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            <label>sales@qualitybag.co.nz</label>
                        </div>
                        <div class="row">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            <label>139 Carrington Rd, Mount Albert, Auckland 1025</label>
                        </div>
                    </div>
                    <div>
                        <iframe frameborder="0" height="300px" width="85%" scrolling="no" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=139+Carrington+Rd,+Mount+Albert,+Auckland&aq=0&oq=QualityTShirt&sll=-36.8809126,174.7081061&ie=UTF8&hq=QualityTShirt,+Inc.,+139+Carrington+Rd,+Mount+Albert,+Auckland&t=m&z=15&iwloc=A&output=embed"></iframe>
                    </div>
                </div>
                <br>
            </div>
            <hr class="dl-horizontal" />

            <div class="col-lg-12 text-center">
                    <form name="sentMessage" id="contactForm" method="post">
                        <?php send_message();?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" placeholder="Your Subject *" id="subject" required data-validation-required-message="Please enter your subject.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" name="submit" class="btn btn-xl">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT .  "/footer.php");?>