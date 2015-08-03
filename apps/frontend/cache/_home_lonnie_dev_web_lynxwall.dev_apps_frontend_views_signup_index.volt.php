

<h2>Sign up using this form</h2>


<?php echo $this->tag->form(array('signup/register')); ?>

<p>
    <label for="name">Name</label>
    <?php echo $this->tag->textField(array('name')); ?>
</p>

<p>
    <label for="email">E-Mail</label>
    <?php echo $this->tag->textField(array('email')); ?>
</p>

<p>
    <?php echo $this->tag->submitButton(array('Register')); ?>
</p>

<?php echo $this->tag->endForm(); ?>