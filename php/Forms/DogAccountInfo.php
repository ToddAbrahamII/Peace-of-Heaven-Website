<?php 
    require_once '../UserHandling/core/init.php';

$user = new User(); //constructor call
$customer = new Customer(); //constructor call 

//checks if user is logged in
if ($user->isLoggedIn()) {

    if(Input::exists()) {

        if(Token::check(Input::get('token'))) {

            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                ### Insert rules that acctInfo fields must meet in addition to js validation ###
            ));

            // If all rules are satisfied, create new customer
            if($validation->passed()) {
                try{
                    //Creates array of all input to be inserted into dog table
                    $dog = new Dog(); //constructor call
                    $customer->findCustInfo($user->data()->id); //Finds matching user id
                    $custid = $customer->data()->CustID; //stores the customer id
                    $dog->create(array(
                        'DogName' => Input::get('DogName'),
                        'Breed' => Input::get('Breed'),
                        'DogDOB' => Input::get('DogDOB'),
                        'Sex' => Input::get('sex'),
                        'isFixed' => Input::get('fixed'),
                        'Weight' => Input::get('DogWeight'),
                        'Color' => Input::get('Color'),
                        'DogOtherInfo' => Input::get('DogOtherInfo'),
                        'CustID' => $custid 
                    ));

                    Redirect::to('../Customer Portal/CustHome.php');

                }
                catch(Exception $e) {
                    die($e->getMessage());
                    
                }
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
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/AcctInfo.css"> -->
</head>
        </head>
    
        <body>
            <form method="POST" class="DogInfo=Form">
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
                            <input type="radio" id="M" name="sex" value="M">
                            <label for="M">Male</label>

                            <input type="radio" id="F" name="sex" value="F">
                            <label for="F">Female</label><br><br>

                            
                            <!-- Gets If the Dog is Fixed from Options -->
                            <label>Has your dog been fixed?</label><br>
                            <input type="radio" id="T" name="fixed" value="1">
                            <label for="T">Fixed</label>

                            <input type="radio" id="F" name="fixed" value="0">
                            <label for="F">Not Fixed</label><br><br>
                            
                            <!-- Gets the Dog's Weight from Input -->
                            <label for="DogWeight"> What is your Dog's Weight</label><br>
                            <input type="number" id="DogWeight" name="DogWeight" required><br><br>

                            <!-- Gets the Dog's Color from Input -->
                            <label for="DogColor">What is your Dog's Color</label><br>
                            <input type="text" id="DogColor" name="DogColor" required><br><br>
                            
                            <!-- Gets the Dog's Other Information -->
                            <label for="DogOtherInfo">Is there anything else you would like to tell us about your dog?</label><br>
                            <input type="text" id="DogOtherInfo" name="DogOtherInfo"><br><br>

                            <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                            <input type="submit" value="Next"><br><br>
                        </p>
                </fieldset>
            </form>
        </body>
    </html>
<?php } ?>