<?php $this->layout = 'login'; ?>

<?php echo $this->Session->flash('auth', array('params' => array('class' => 'alert alert-error'))); ?>

      <div class="row">
        <div class="login-form">
          <h2>Login</h2>
          <?php echo $this->Form->create('User'); ?>
		  <fieldset>
		  		<legend><?php echo __(''); ?></legend>

                <div class="clearfix">
                  <?php echo $this->Form->input('username'); ?>
                </div>

                <div class="clearfix">
                  <?php echo $this->Form->input('password'); ?>
                </div>
          </fieldset>
          <?php echo $this->Form->end(__('Sign in')); ?>
        </div>
      </div> <!-- /row -->