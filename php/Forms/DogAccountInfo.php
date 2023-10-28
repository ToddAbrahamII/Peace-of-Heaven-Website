<?php
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
                            <input type="radio" id="M" name="sex" value="M">
                            <label for="M">Male</label>

                            <input type="radio" id="F" name="sex" value="F">
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
                <fieldset>
                        <!-- Collects information for DogBehavior Table -->
                        <legend>Dog Behavior Information</legend>

                            <legend>1. What is your dogs previous daycare and/or boarding experience</legend> 
                            <input type="radio" id="1a" name="experience" value="1a">
                            <label for="1a">a. Never attempted either</label>
                            <br>
                            <input type="radio" id="1b" name="experience" value="1b">
                            <label for="1b">b. Boarding and/or daycare client in past but no more than twice a year</label>
                            <br>
                            <input type="radio" id="1c" name="experience" value="1c">
                            <label for="1c">c. Has been at least once but stresses easily or does not adjust well to unfamiliar environments</label> 
                            <br>
                            <input type="radio" id="1d" name="experience" value="1d">
                            <label for="1d">d. Boarded regularly & adjusts easily</label>
                            <br>
                            <input type="radio" id="1e" name="experience" value="1e">
                            <label for="1e">e. Attends daycare often & socializes well</label>
                    </p>
    
    
                    <p>
                        <legend>2. Do you want your dog to engage in social play with dogs of like-size & similar temperament?</legend>
                        <input type="radio" id="2yes" name="social_play" value="yes">
                        <label for="2yes">YES</label>
                        <input type="radio" id="2no" name="social_play" value="no">
                        <label for="2no">NO</label>
                    </p>
    
    
                    <p>
                        <legend>3. Has your dog ever growled, snipped, bit, or shown any other aggressive reaction towards people or pets?</legend>
                        <input type="radio" id="3yes" name="aggressive_reaction" value="yes">
                        <label for="3yes">YES</label>
                        <input type="radio" id="3no" name="aggressive_reaction" value="no">
                        <label for="3no">NO</label>
                        <br>
    
                        &nbsp;&nbsp; <!-- Temp. tabs until we decide if we want to put text areas in divs and format with CSS-->
                        <label for="aggressive_encounter">a. If yes, please provide brief description of encounter(s).</label>
                        <br>
                        &nbsp;&nbsp;
                        <textarea name="aggressive_encounter" id="aggressive_encounter"></textarea>
    
                    </p>
    
    
                    <p>
                        <legend>4. Is your dog a...</legend>
    
                        <label>a. Jumper? </label>
                        <input type="radio" id="4a_yes" name="jumping" value="yes">
                        <label for="4a_yes">YES</label>
                        <input type="radio" id="4a_no" name="jumping" value="no">
                        <label for="4a_no">NO</label>
                        <br>
    
                        <label>b. Climber? </label>
                        <input type="radio" id="4b_yes" name="climbing" value="yes">
                        <label for="4b_yes">YES</label>
                        <input type="radio" id="4b_no" name="climbing" value="no">
                        <label for="4b_no">NO</label>
                        <br>
    
                        <label>c. Aggressive chewer? </label>
                        <input type="radio" id="4c_yes" name="chewing" value="yes">
                        <label for="4c_yes">YES</label>
                        <input type="radio" id="4c_no" name="chewing" value="no">
                        <label for="4c_no">NO</label>
                        <br>
    
                        <label>d. Escape artist of any kind? </label>
                        <input type="radio" id="4d_yes" name="escaping" value="yes">
                        <label for="4d_yes">YES</label>
                        <input type="radio" id="4d_no" name="escaping" value="no">
                        <label for="4d_no">NO</label>
                        <br>
    
                        &nbsp;&nbsp;
                        <label for="escaping_desc">i. If yes, please describe his/her escaping abilities.</label>
                        <br>
                        &nbsp;&nbsp;
                        <textarea name="escaping_desc" id="escaping_desc"></textarea>
                    </p>
    
    
                    <p>
                        <legend>5. Do you prefer your dog to participate in water activities (weather permitting)?</legend>
                        <input type="radio" id="5yes" name="weather" value="yes">
                        <label for="5yes">YES</label>
                        <input type="radio" id="5no" name="weather" value="no">
                        <label for="5no">NO</label>
                    </p>
    
                    <p>
                        <legend>6. Is your dog permitted to have edible treats? </legend>
                        <input type="radio" id="6yes" name="weather" value="yes">
                        <label for="6yes">YES</label>
                        <input type="radio" id="6no" name="weather" value="no">
                        <label for="6no">NO</label>
                    </p>
    
    
                    <p>
                        <legend>7. Any activity limitations or time restrictions? </legend>
                        <input type="radio" id="7yes" name="time_restrictions" value="yes">
                        <label for="7yes">YES</label>
                        <input type="radio" id="7no" name="time_restrictions" value="no">
                        <label for="7no">NO</label>
                        <br>
    
                        &nbsp;&nbsp;
                        <label for="seven_desc">a. If yes, please describe.</label>
                        <br>
                        &nbsp;&nbsp;
                        <textarea name="seven_desc" id="seven_desc"></textarea>
                    </p>
    
    
                    <p>
                        <legend>8. Name a few of your dog's favorite toys or games to play.</legend>
                        <textarea name="toys" id="toys"></textarea>
    
                        <legend>9. Please describe any other behaviors, prefrences, or routines we should know about your dog.</legend>
                        <textarea name="routines" id="routines"></textarea>
    
                        <legend>10. Are there any training commands or activities we can continue to reinforce (if possible) while in our care? If so, please list.</legend>
                        <textarea name="reinforce" id="reinforce"></textarea>
    
                        <legend>11. What commands does your dog know?</legend>
                        <textarea name="commands" id="commands"></textarea>
                        <br>
    
                        <label for="leash">12. Is your dog comfortable walking on a leash?</label>
                        <input type="radio" id="12yes" name="leash" value="yes">
                        <label for="12yes">YES</label>
                        <input type="radio" id="12no" name="leash" value="no">
                        <label for="12no">NO</label>
                        <br>
    
                        <label for="feeding">13. What is your dog's feeding scheduel?</label>
                        <input type="text" name="feeding" id="feeding">
                        <br>
    
                        <label for="potty">14. What is your dog's normal potty routine?</label>
                        <input type="text" name="potty" id="potty">

                            <!-- Checks if Dog is escape artist -->

                            <!-- Checks if Dog is a climber -->

                            <!-- Checks if Dog is leash trained -->

                            <!-- Checks if Dog is a chewer -->

                            <!-- Checks Dogs Bathroom Routine -->

                            <!-- Checks any other information regarding behavior -->
                </fieldset>
                <fieldset>
                        <!-- Collects information for DogHealth Table -->
                        <legend>Dog Health Information</legend>

                        <p>
                            <!-- Vet Name -->

                            <!-- Vet Phone -->

                            <!-- Vet Address -->

                            <!-- Vet City -->

                            <!-- Vet State -->

                            <!-- Vet Zip -->

                            <!-- Allergies -->

                            <!-- Medical Conditions -->

                            <!-- Impairments -->

                            <!-- Other Health Information -->

                        </p>

                        <!-- Collects information for DogVaccine Table -->
                      
                     
                  rea name="seven_desc" id="seven_desc"></textarea>
                    </p>
    
    
                    
    
                        <legend>15. List all known allergies.</legend>
                        <textarea name="allergies" id="allergies"></textarea>
    
                        <legend>16. List all medication & dose frequency.</legend>
                        <textarea name="medication" id="medication"></textarea>
                    </p>
    
                </fieldset>
            </form>
        </body>
    </html>