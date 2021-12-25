<h1>Contact Us</h1>
<div class="w-50 m-auto">

        <?php
       //if (isset($_SESSION['message'])) {
       //    echo $_SESSION['message'] ; //выводим из сессии сообщение об ошибке 
       //    unset($_SESSION['message']);
       //}
       showMessage();
        ?>


        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="ajax-form">
            <div class="form-group mt-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control"  id="name" name="name" value="<?=getOldData('name')?>">

            </div>
            <div class="form-group mt-3">
                <label for="email">email:</label>
                <input type="text" class="form-control" id="email" name="email" value="<?=getOldData('email')?>">

            </div>
            <div class="form-group mt-3">
                <label for="message">message:</label>
                <textarea class="form-control" id="message" name="message"><?=getOldData('message')?></textarea>
                <button class="btn btn-primary mt-3" name="action" value="sendMail">Send</button>

            </div>
        </form>


        




    </div>