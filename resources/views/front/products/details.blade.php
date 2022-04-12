<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<!DOCTYPE html>
<html>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 item-photo">
                <img style="max-width:100%;"
                    src="https://ak1.ostkcdn.com/images/products/8818677/Samsung-Galaxy-S4-I337-16GB-AT-T-Unlocked-GSM-Android-Cell-Phone-85e3430e-6981-4252-a984-245862302c78_600.jpg" />
            </div>
            <div class="col-xs-5" style="border:0px solid gray">
                <!-- Datos del vendedor y titulo del producto -->
                <h3>{{ $products->title }}</h3>
                <br>
                <h3 style="margin-top:0px;">BDT {{ $products->price}}</h3>

                <!-- Detalles especificos del producto -->

                <br>
                <!-- Botones de compra -->
                <div class="section" style="padding-bottom:20px;">
                    <button class="btn btn-success"><span style="margin-right:20px"
                            class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to cart</button>

                </div>
            </div>

            <div class="col-xs-9">
                <ul class="menu-items">

                </ul>

                <div style="width:100%;border-top:1px solid silver">
                    <p style="padding:15px;">
                        <h3>Description:</h3>

                        <h4>
                            {{ $products->description }}
                        </h4>
                    </p>
                    <br>
                    <small>
                        <ul>
                            <li>Super AMOLED capacitive touchscreen display with 16M colors</li>
                            <li>Available on GSM, AT T, T-Mobile and other carriers</li>
                            <li>Compatible with GSM 850 / 900 / 1800; HSDPA 850 / 1900 / 2100 LTE; 700 MHz Class 17 /
                                1700 / 2100 networks</li>
                          
                            <li>Available in white or black</li>
                            <li>Model I337</li>
                            <li>Package includes phone, charger, battery and user manual</li>
                            <li>Phone is 5.38 inches high x 2.75 inches wide x 0.13 inches deep and weighs a mere 4.59
                                oz </li>
                        </ul>
                    </small>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
