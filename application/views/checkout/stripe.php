<style>
/* Padding - just for asthetics on Bootsnipp.com */
body {
    margin-top: 20px;
}

/* CSS for Credit Card Payment form */
.credit-card-box .panel-title {
    display: inline;
}

.credit-card-box .form-control.error {
    border-color: red;
    outline: 0;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
}

.credit-card-box label.error {
    font-weight: bold;
    color: red;
    padding: 2px 8px;
    margin-top: 2px;
}

.credit-card-box .payment-errors {
    font-weight: bold;
    color: red;
    padding: 2px 8px;
    margin-top: 2px;
}

.credit-card-box label {
    display: block;
}

/* The old "center div vertically" hack */
.credit-card-box .display-table {
    display: table;
}

.credit-card-box .display-tr {
    display: table-row;
}

.credit-card-box .display-td {
    display: table-cell;
    vertical-align: middle;
    width: 50%;
}

/* Just looks nicer */
.credit-card-box .panel-heading img {
    min-width: 180px;
}
</style>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->
        <div class="col-xs-12 col-md-6">
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading" align="center">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="panel-title display-td title font-color-light-blue">Payment Details</h3>
                        </div>
                        <div class="col-lg-6 pt-n1 justify-content-center">
                            <img class="img-responsive" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form" id="payment-form" method="POST" action="javascript:void(0);">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="cardNumber" class="font-color-light-blue mb-0 font-color-gray">card
                                        number</label>
                                    <input type="tel"
                                        class="form-control focus <?php echo $theme ? "brightly" : "darkly" ?>-form-control"
                                        name="cardNumber" placeholder="Valid Card Number" autocomplete="cc-number"
                                        required autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="cardExpiry" class="font-color-light-blue mb-0 font-color-gray"><span
                                            class="hidden-xs">expiration</span><span
                                            class="visible-xs-inline"></span> date</label>
                                    <input type="tel"
                                        class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control"
                                        name="cardExpiry" placeholder="MM / YY" autocomplete="cc-exp" required />
                                </div>
                            </div>
                            <div class="col-lg-5 pull-right">
                                <div class="form-group">
                                    <label for="cardCVC" class="font-color-light-blue mb-0 font-color-gray">cv
                                        code</label>
                                    <input type="tel"
                                        class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control"
                                        name="cardCVC" placeholder="CVC" autocomplete="cc-csc" required />
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <button class="subscribe btn <?php echo $theme ? "brightly-btn" : "dark-purple-button"; ?> btn-lg btn-block" type="button">pay
                                    now ($<?php echo $amount; ?>)</button>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-lg-12">
                                <p class="payment-errors"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- CREDIT CARD FORM ENDS HERE -->
        </div>
    </div>
</div>
<script>
    let config_publish_key = "<?php echo $publish_key;  ?>"
</script>