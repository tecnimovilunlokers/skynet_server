<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
<div class="d-flex align-items-center justify-content-center w-100">
  <div class="row justify-content-center w-100">
	<div class="col-md-8 col-lg-6 col-xxl-3">
	  <div class="card mb-0">
		<div class="card-body pt-5">
		  <a href="#" class="text-nowrap w-100 logo-img text-center d-block mb-4">
			<?=$this->Html->image('logo.png', array('width' => '180'));?>
		  </a>
		  <div class="mb-5 text-center">
			<p>We sent a verification code to your telegram with chat id ending in</p>
			<h6 class="fw-bolder"><?=$chat_id?></h6>
		  </div>
		   <form action="<?=Configure::read('BASE_URL')?>challenge/verify_challenge" method="POST">
			<div class="mb-3">
			  <label for="exampleInputEmail1" class="form-label fw-semibold">Type your 6 digits security code</label>
			  <div class="d-flex align-items-center gap-2">
				<input name="digits[]" type="text" class="form-control p-0 fs-8 fw-bold text-center trailing-input" maxlength="1">
				<input name="digits[]" type="text" class="form-control p-0 fs-8 fw-bold text-center trailing-input" maxlength="1">
				<input name="digits[]" type="text" class="form-control p-0 fs-8 fw-bold text-center trailing-input" maxlength="1">
				<input name="digits[]" type="text" class="form-control p-0 fs-8 fw-bold text-center trailing-input" maxlength="1">
				<input name="digits[]" type="text" class="form-control p-0 fs-8 fw-bold text-center trailing-input" maxlength="1">
				<input name="digits[]" type="text" class="form-control p-0 fs-8 fw-bold text-center trailing-input" maxlength="1">
			  </div>
			</div>
			<button type="submit" class="btn btn-primary w-100 py-8 mb-4">Verify My Account</button>
			<div class="d-flex align-items-center">
			  <p class="fs-4 mb-0 text-dark">Didn't get the code?</p>
			  <a class="text-primary fw-medium ms-2" href="<?=Configure::read('BASE_URL')?>challenge/resend_challenge">Resend</a>
			</div>
		   </form>
		</div>
	  </div>
	</div>
  </div>
</div>
</div>

<script>
$( document ).ready(function() {
	$('.trailing-input').on('input', function() {
        var currentInput = $(this);
        var val = currentInput.val().replace(/\D/g, '');
		this.value = val;
        if (val.length > 0) {
            currentInput.next('.trailing-input').focus();
        }
    });

    $('.trailing-input').on('paste', function(e) {
        e.preventDefault();
		var pasteData = (e.originalEvent.clipboardData || window.clipboardData).getData('text').trim();
		var remainingData = "";
        var currentInput = $(this);
		var nextInputs = $(this).nextAll('.trailing-input');
		var maxLength = parseInt(currentInput.attr('maxlength'), 10);
		var val = pasteData.substr(0,maxLength).replace(/\D/g, '');
		
		if (val.length > 0) {
			remainingData = pasteData.substring(0, 0) + pasteData.substring(maxLength);
			currentInput.val(val);
			currentInput.next('.trailing-input').focus();
		}
		
		$.each(nextInputs,function(){
			if(remainingData.length > 0){
				maxLength = parseInt($(this).attr('maxlength'), 10);
				val = remainingData.substr(0,maxLength).replace(/\D/g, '');
				if (val.length > 0) {
					remainingData = remainingData.substring(0, 0) + remainingData.substring(maxLength);
					$(this).val(val);
					$(this).next('.trailing-input').focus();
				}
			}
		});
		
    });

    $('.trailing-input').on('keydown', function(e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode === 8 || keyCode === 46) { // Check for backspace or delete keys
            var currentInput = $(this);
            var currentInputIndex = $('.trailing-input').index(currentInput);
            if (currentInput.val().length === 0 && currentInputIndex > 0) {
                $('.trailing-input').eq(currentInputIndex - 1).focus().val('');
            }
        }
    });
	
	
});
</script>