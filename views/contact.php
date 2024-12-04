<?php
/**
 * Project:  phpMvc
 * FileName: contact.php
 * User:     abbass
 * Time:     11:59
 * Date:     2022/04/28
 */

?>
<h1>Contact Page</h1>

<form action="" method="post" >
    <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Subject</label>
        <input type="text" class="form-control" name="subject" id="validationCustom01">
    </div>
    <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="validationCustom01">
    </div>
    <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Mobile</label>
        <input type="text" class="form-control" name="mobile" id="validationCustom01">
    </div>

    <div class="col-12">
        <button class="btn btn-primary" type="submit">Submit form</button>
    </div>
</form>