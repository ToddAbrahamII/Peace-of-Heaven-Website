<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    include("connection.php"); //Needed for making login required, calls other php page
    include("functions.php");//Needed for making login required, calls other php page

    <body>
        <form>
            <fieldset>

            <legend>Vaccinations</legend>  
                <p>
                    <p>**All dogs accepted for day care must be vaccinated for DHPP, Rabies, & Bordetella**<br>
                    **Proof of current vaccination for all required vaccines must be shown upon arrival**</p>

                    <label for="dhpp_date">DHPP Date:</label>
                    <input type="date" name="dhpp_date" id="dhpp_date">

                    <label for="rabies_date">Rabies Date:</label>
                    <input type="date" name="rabies_date" id="rabies_date">

                    <label for="bordetella_date">Bordetella Date(6 or 12 mo.):</label>
                    <input type="date" name="bordetella_date" id="bordetella_date">
                </p>

                <legend>Preventatives</legend>
                <p>
                    <p>*Heartworm & flea/tick preventative treatments are recommended for day care clients*<br>
                    *If fleas/ticks are found on client during stay, client will be treated at owner&quots expense.*</p>

                    <label for="flea_product"><br>Flea/Tick product:</label>
                    <input type="text" name="flea_product" id="flea_product">

                    <label for="flea_date">Last date given:</label>
                    <input type="date" name="flea_date" id="flea_date">
                </p>

            </fieldset>
        </form>
    </body>
?>