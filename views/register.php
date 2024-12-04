<?php
/**
 * Project:  phpMvc
 * FileName: contact.php
 * User:     abbass
 * Time:     11:59
 * Date:     2022/04/28
 */

?>
<h1>Register Page</h1>

<?php $form =  \app\core\form\Form::begin('' , 'post')?>
        <div class="row">
            <div class="col"> <?php echo $form->field($model , 'first_name')?></div>
            <div class="col">  <?php echo $form->field($model , 'last_name')?></div>
        </div>


    <?php echo $form->field($model , 'email')?>
    <?php echo $form->field($model , 'password')->passwordField()?>
    <?php echo $form->field($model , 'confirm_password')->passwordField()?>

<button class="btn btn-primary" type="submit">Submit form</button>

<?php echo \app\core\form\Form::end()?>

<!--<form action="" method="post">-->
<!--    <div class="row">-->
<!--        <div class="col">-->
<!--            <div class="form-group">-->
<!--                <label for="validationCustom01" class="form-label">First Name</label>-->
<!--                <input type="text" value="--><?php //echo $model->first_name;?><!--"-->
<!--                       class="form-control--><?php //echo $model->hasError('first_name') ? ' is-invalid' : '' ?><!--"  name="first_name" id="validationCustom01">-->
<!--                <div class="invalid-feedback">-->
<!--                    --><?php //echo $model->getFirstError('first_name')?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col">-->
<!--            <label for="validationCustom01" class="form-label">Last Name</label>-->
<!--            <input type="text" class="form-control" value="--><?php //echo $model->last_name;?><!--" name="last_name" id="validationCustom01">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-md-4">-->
<!--        <label for="validationCustom01" class="form-label">Email</label>-->
<!--        <input type="email" class="form-control" name="email" id="validationCustom01">-->
<!--    </div>-->
<!--    <div class="col-md-4">-->
<!--        <label for="validationCustom01" class="form-label">Password</label>-->
<!--        <input type="password" class="form-control" name="password" id="validationCustom01">-->
<!--    </div>-->
<!--    <div class="col-md-4">-->
<!--        <label for="validationCustom01" class="form-label">Confirm Password</label>-->
<!--        <input type="password" class="form-control" name="confirm_password" id="validationCustom01">-->
<!--    </div>-->
<!---->
<!--    <div class="col-12">-->
<!--        <button class="btn btn-primary" type="submit">Submit form</button>-->
<!--    </div>-->
<!--</form>-->