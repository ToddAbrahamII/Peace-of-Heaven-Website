<?phprequire_once 'core/init.php';

$user = new User();

if ($user->isLoggedIn()) {

    if(Input::exists()) {
        if(Token::check(Input::get('token'))) {
            
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                ### Insert rules that acctInfo fields must meet in addition to js validation ###
            ));

            // If all rules are satisfied, create new customer
            if($validation->passed()) {
                $dog = new Dog();

                try{
                    $dog->create(array(
                        'DogName' => Input::get('DogName'),
                        'Breed' => Input::get('Breed'),
                        'DogDOB' => Input::get('DogDOB'),
                        

                    ));

                }
                catch(Exception $e) {
                    die($e->getMessage());
                }else {
                    // output errors
                    foreach ($validation->errors() as $error) {
                        echo $error, '<br>';
                     }
                 }
            
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
    
        </head>
    
        <body>
            <form>
                <fieldset>
                        <!-- Collects information for Dog Table -->
                        <legend>Dog General Information</legend>
                    <p> 
                            <!-- Gets Dog Name From Input -->
                            <label for="DogName">What is your Dog's Name? </label><br>
                            <input type="text" name="DogName" id="DogName" required><br><br>

                            <!-- Gets Dog Breed From Input -->
                            <label for="Breed">What is your Dog's Breed? </label><br>
                            <input type="text" name="Breed" id="Breed" required><br><br>

                            <!-- Gets Dog DOB From Input -->
                            <label for="DogDOB">What is your Dog's Date of Birth?</label><br>
                            <input type="date" name ="DogDOB" id="DogDOB" required><br><br>
                            
                            <!-- Gets Dog Sex from Male and Female Option -->
                            <label for="DogSex">What is the Sex of your Dog?</label><br>
                            <input type="radio" id="M" name="sex" value="1">
                            <label for="M">Male</label>

                            <input type="radio" id="F" name="sex" value="0">
                            <label for="F">Female</label><br><br>

                            
                            <!-- Gets If the Dog is Fixed from Options -->
                            <label>Has your dog been fixed?</label><br>
                            <input type="radio" id="T" name="fixed" value="1">
                            <label for="T">Fixed</label>

                            <input type="radio" id="F" name="fixed" value="0">
                            <label for="F">Not Fixed</label>
                            
                            <!-- Gets the Dog's Weight from Input -->
                            <label for="DogWeight"> What is your Dog's Weight</label><br>
                            <input type="number" id="DogWeight" name="DogWeight" required><br><br>

                            <!-- Gets the Dog's Color from Input -->
                            <label for="DogColor">What is your Dog's Color</label><br>
                            <input type="text" id="DogColor" name="DogColor" required><br><br>
                            
                            <!-- Gets the Dog's Other Information -->
                            <label for="DogOtherInfo">Is there anything else you would like to tell us about your dog?</label><br>
                            <input type="text" id="DogOtherInfo" name="DogOtherInfo"><br><br>
                        </p>
                </fieldset>
            </form>
        </body>
    </html>
<?php } ?>