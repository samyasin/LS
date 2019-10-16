
<?php include 'config.php'; ?>
<!-- Footer Area Start Here -->
<footer>

    <?php
    $retImage    = "SELECT * FROM ads";
    $resImage    = mysqli_query($con, $retImage);
    $num_row     = mysqli_num_rows($resImage);
    $i           = 0;
    ?>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height:400px">
        <ol class="carousel-indicators">
            <?php while($i < $num_row){ ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" <?php echo $i==0?'class="active"':''; ?>></li>
            <?php $i++; } ?>
        </ol>
        <div class="carousel-inner" style="height: 100%;">
            <?php
            $i = 0;
            while($image = mysqli_fetch_assoc($resImage)){ ?>
                <div class="carousel-item <?php echo $i==0? 'active':''; ?>">
                    <img class="d-block w-100" src="<?php echo '../admin/' . $image['ads_img']; ?>" alt="First slide" style="max-height: 100%;object-fit: contain">
                </div>
            <?php $i++; }?>
<!--            <div class="carousel-item active">-->
<!--                <img class="d-block w-100" src="..." alt="First slide">-->
<!--            </div>-->
<!--            <div class="carousel-item">-->
<!--                <img class="d-block w-100" src="..." alt="Second slide">-->
<!--            </div>-->
<!--            <div class="carousel-item">-->
<!--                <img class="d-block w-100" src="..." alt="Third slide">-->
<!--            </div>-->
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>





    <div class="footer-area-top s-space-equal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-box">
                        <h3 class="title-medium-light title-bar-left size-lg">About us</h3>
                        <ul class="useful-link">
                            <li>
                                <a href="about.php">About us</a>
                            </li>
                            <li>
                                <a href="career.php">Career</a>
                            </li>
                            <li>
                                <a href="condition.php">Terms &amp; Conditions</a>
                            </li>
                            <li>
                                <a href="privacy.php">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="sitemap.php">Sitemap</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-box">
                        <h3 class="title-medium-light title-bar-left size-lg">How to sell fast</h3>
                        <ul class="useful-link">
                            <li>
                                <a href="#">How to sell fast</a>
                            </li>
                            <li>
                                <a href="#">Buy Now on Classipost</a>
                            </li>
                            <li>
                                <a href="#">Membership</a>
                            </li>
                            <li>
                                <a href="#">Banner Advertising</a>
                            </li>
                            <li>
                                <a href="#">Promote your ad</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-box">
                        <h3 class="title-medium-light title-bar-left size-lg">Help &amp; Support</h3>
                        <ul class="useful-link">
                            <li>
                                <a href="#">Live Chat</a>
                            </li>
                            <li>
                                <a href="faq.php">FAQ</a>
                            </li>
                            <li>
                                <a href="#">Stay safe on classipost</a>
                            </li>
                            <li>
                                <a href="contact.php">Contact us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-box">
                        <h3 class="title-medium-light title-bar-left size-lg">Follow Us On</h3>
                        <ul class="folow-us">
                            <li>
                                <a href="#">
                                    <img src="img/footer/follow1.jpg" alt="follow">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="img/footer/follow2.jpg" alt="follow">
                                </a>
                            </li>
                        </ul>
                        <ul class="social-link">
                            <li class="fa-classipost">
                                <a href="#">
                                    <img src="img/footer/facebook.jpg" alt="social">
                                </a>
                            </li>
                            <li class="tw-classipost">
                                <a href="#">
                                    <img src="img/footer/twitter.jpg" alt="social">
                                </a>
                            </li>
                            <li class="yo-classipost">
                                <a href="#">
                                    <img src="img/footer/youtube.jpg" alt="social">
                                </a>
                            </li>
                            <li class="pi-classipost">
                                <a href="#">
                                    <img src="img/footer/pinterest.jpg" alt="social">
                                </a>
                            </li>
                            <li class="li-classipost">
                                <a href="#">
                                    <img src="img/footer/linkedin.jpg" alt="social">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-area-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-center-mb">
                    <p>Copyright � classipost</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right text-center-mb">
                    <ul>
                        <li>
                            <img src="img/footer/card1.jpg" alt="card">
                        </li>
                        <li>
                            <img src="img/footer/card2.jpg" alt="card">
                        </li>
                        <li>
                            <img src="img/footer/card3.jpg" alt="card">
                        </li>
                        <li>
                            <img src="img/footer/card4.jpg" alt="card">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End Here -->
</div>
<!-- Report Abuse Modal Start-->
<div class="modal fade" id="report_abuse" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content report-abuse-area radius-none">
            <div class="gradient-wrapper">
                <div class="gradient-title">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="item-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>There's
                    Something Wrong With This Ads?</h2>
                </div>
                <div class="gradient-padding reduce-padding">
                    <form id="report-abuse-form">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Your E-mail</label>
                            <input type="text" id="first-name" class="form-control"
                            placeholder="Type your mail here ...">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label class="control-label" for="first-name">Your Reason</label>
                                <textarea placeholder="Type your reason..." class="textarea form-control"
                                name="message" id="form-message" rows="7" cols="20"
                                data-error="Message field is required" required></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="cp-default-btn-sm">Submit Now!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Report Abuse Modal End-->
<!-- jquery-->

</script>
<script src="js/jquery-3.2.1.min.js"></script>
<!-- Popper js -->
<script src="js/popper.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- Owl Cauosel JS -->
<script src="vendor/OwlCarousel/owl.carousel.min.js"></script>
<!-- Meanmenu Js -->
<script src="js/jquery.meanmenu.min.js"></script>
<!-- Srollup js -->
<script src="js/jquery.scrollUp.min.js"></script>
<!-- jquery.counterup js -->
<script src="js/jquery.counterup.min.js"></script>
<script src="js/waypoints.min.js"></script>
<!-- Select2 Js -->
<script src="js/select2.min.js"></script>
<!-- Isotope js -->
<script src="js/isotope.pkgd.min.js"></script>
<!-- Magnific Popup -->
<script src="js/jquery.magnific-popup.min.js"></script>
<!-- jQuery Zoom -->
<script src="js/jquery.zoom.min.js"></script>
<!-- Google Map js -->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe4u1WlIBqQjaSlBmbRwE0n41Jtvcm6JE"></script>-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!-- Custom Js -->
<script src="js/main.js"></script>

<script>
    $(document).ready(function () {
        $('.carousel').carousel({
            interval: 2000,
            keyboard: true,
            pause: "hover"
        });


        // height of carousel
        var res = $('.carousel').width() / 2;
        if(res > 400){
            res = 400;
        }
        $('.carousel').height(res);

        $(window).resize(function () {
            var res = $('.carousel').width() / 2;
            if(res > 400){
                res = 400;
            }
            $('.carousel').height(res);
        });

        setTimeout(function () {
            $('iframe .place-card, iframe .place-card-large').addClass('hide');
        },2000);

    });
</script>