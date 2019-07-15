<?php include 'includes/header.php'; ?>
        <!-- Contact Area Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="index.php">Home</a> -</li>
                        <li class="active">Contact Page</li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="gradient-wrapper mb--sm">
                            <div class="gradient-title">
                                <h2>Contact With us</h2>
                            </div>
                            <div class="contact-layout1 gradient-padding">
                                <div class="google-map-area">
                                    <div id="googleMap" style="width:100%; height:400px;"></div>
                                </div>
                                <p>If you did not find the answer to your question or problem, please get in touch with us using the form below and we will respond to your message as soon as possible.</p>
                                <form id="contact-form" class="contact-form">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Your Name" class="form-control" name="name" id="form-name" data-error="Name field is required" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="email" placeholder="Your E-mail" class="form-control" name="email" id="form-email" data-error="Email field is required" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Subject" class="form-control" name="subject" id="form-subject" data-error="Subject field is required" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea placeholder="Message" class="textarea form-control" name="message" id="form-message" rows="7" cols="20" data-error="Message field is required" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <button type="submit" class="cp-default-btn-sm">Send Message</button>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 col-sm-12 col-12">
                                                <div class='form-response'></div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="sidebar-item-box">
                            <ul class="sidebar-more-option">
                                <li>
                                    <a href="post-ad.html"><img src="img/banner/more1.png" alt="more" class="img-fluid">Post a Free Ad</a>
                                </li>
                                <li>
                                    <a href="#"><img src="img/banner/more2.png" alt="more" class="img-fluid">Manage Product</a>
                                </li>
                                <li>
                                    <a href="favourite-ad-list.html"><img src="img/banner/more3.png" alt="more" class="img-fluid">Favorite Ad list</a>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-item-box">
                            <img src="img/banner/sidebar-banner1.jpg" alt="banner" class="img-fluid m-auto">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Area End Here -->
        <?php include 'includes/footer.php'; ?>
</body>


<!-- Mirrored from radiustheme.com/demo/html/classipost/classipost/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Jun 2019 10:29:29 GMT -->
</html>