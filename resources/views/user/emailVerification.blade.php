<style>
    body {
        overflow: scroll;
        background-color: white !important;
    }

    .thank_img {
        justify-content: center;
        margin: auto;
        /* display: flex; */
        text-align: center;
        padding: 15px 0;
        flex-direction: column;
        width: 500 px;
        height:500 px;
    }

    .thankyou {
        background-color: #fff !important;
    }

    h5 {
        text-align: center;
        font-size: 24px;
        /* color: #7f77ff; */
        font-weight: 600;
    }

    .logo {
        width: 135px;
        /* height: 60px; */
    }

    .thank_img img {
        width: 10%;
        /* height: 100%; */
        object-fit: cover;
    }

    p {
        font-size: 16px;
        text-align: center;
        font-weight: 400;
        margin: 20px 0;
        line-height: 30px;
    }

    h5 {
        font-size: 26px;
        font-weight: 800;
    }

    .email_btn {
        color: #fff;
        background-color: #089D93;
        font-size: 18px;
        font-weight: 600;
        padding: 15px 30px;
        border-radius: 38px;

    }

    .email_btns {
        width: 100%;
        float: left;
        margin: 30px 0;
    }

    .dashboard_btn {
        text-align: center;
        clear: both;
        display: flex;
        justify-content: center;
        flex-direction: row;
    }

    .margin_div {
        margin: 0 2px;
    }

    p {
        width: 100%;
        float: left;
    }
</style>

<div class="thankyou">
    <div class="container">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card-body" style="text-align: center;">
                </div>
                 <div class="thank_img col-md-2 m-auto">
                    <!-- <img src="{{ url('public/thankyou1.png') }}" alt="" class="img-fluid my-4"> -->
                </div>
                 <div class="thank_img col-md-2 m-auto">
                    <!-- <img src="{{ url('public/thankyou1.png') }}" alt="" class="img-fluid my-4"> -->
                </div>
                <!-- <div class="thank_img col-md-2 m-auto"> -->
                    <!-- <img src="{{ url('public/logo.jpg') }}" alt="" class="logo" /> -->
                    <!-- <p>You have successfully verified</p> -->
                <!-- </div> -->
                <!-- <div class="thank_img col-md-2 m-auto">
                    <img src="{{ url('public/thankyou1.png') }}" alt="" class="img-fluid my-4">
                </div> -->

                @if (isset($is_userverified))
                    <div class="col-md-6 m-auto">
                        <h5 style="color:green;">{{ $is_userverified }}</h5>
                        <h5>Thank You For Registration!</h5>
                        <!-- <p>You have successfully register at {{ config('app.name') }}. Please click on the email received and verify your
                            account.</p> -->
                    </div>

                    @if (!empty($loginUrl))
                        <div class="email_btns" style="text-align: center;"> <a href="{{ $loginUrl }}"
                                class="f-w-400 email_btn">Back To Login</a></div>
                        <div class="dashboard_btn" style="text-align: center;"></div>
                    @endif
                @elseif(isset($invalid))
                    <div class="col-md-6 m-auto">
                        <h5 style="color:red;">{{ $invalid }}</h5>
                        <h5>Token invalid, Please resend the request!</h5>
                    </div>
                @elseif(isset($wrong_email))
                    <div class="col-md-6 m-auto">
                        <h5>{{ $wrong_email }}!</h5>
                        <h5>something went wrong!</h5>
                    </div>
                @endif

                <footer class="site-footer" id="footer" style="padding-top: 10px;">
                    <p class="site-footer__fineprint" id="fineprint">Copyright ©2023| All Rights Reserved|
                        <b>{{ config('app.name') }}</b></p>
                </footer>
            </div>
        </div>
    </div>
</div>
