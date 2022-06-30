<?php

use common\models\User;

$base_url = Yii::getAlias("@web");
//FIND MODEL
$model = User::findOne(Yii::$app->user->id);
?>

<div class="container">
	<div id="frame">
		<div id="sidepanel">

			<div id="contacts">
				<ul>
					<li class="contact active">
						<div class="wrap">
							<span class="contact-status busy"></span>
							<img src="<?= $base_url ?>/profile/uploads/<?= $model->image_url ?>" alt="" / style="width:50px;height:50px;object-fit:cover;">
							<div class="meta">
								<p class="name"><?= Yii::$app->user->identity->username ?></p>
								<p class="preview"></p>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div id="bottom-bar">
				<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add
						contact</span></button>
				<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
			</div>
		</div>
		<div class="content">
			<div class="contact-profile">
				<img src="<?= $base_url ?>/profile/uploads/<?= $model->image_url ?>" alt="" / style="width:50px;height:50px;object-fit:cover;">
				<p><?= Yii::$app->user->identity->username ?></p>
				<div class="social-media">
					<i class="fa fa-facebook" aria-hidden="true"></i>
					<i class="fa fa-twitter" aria-hidden="true"></i>
					<i class="fa fa-instagram" aria-hidden="true"></i>
				</div>
			</div>
			<div class="messages">
				<ul>
					<?php
					if (!empty($messageData)) {
						foreach ($messageData as $key => $value) {
							$createdDateTime = date_format(date_create($value->created_at), 'd M, Y h:i a');
					?>
							<?php
							if (!empty($value->user_id)) {
							?>
								<li class="replies">
									<img src="<?= $base_url ?>/profile/uploads/<?= $model->image_url ?>" alt="" / style="width:30px;height:30px;object-fit:cover;">
									<p><?= $value->content ?></p>
								</li>
							<?php
							} else {
							?>
								<li class="sent">
									<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
									<p><?= $value->content ?></p>
								</li>
							<?php }
							?>
					<?php
						}
					}
					?>
				</ul>
			</div>
			<div class="message-input">
				<div class="wrap">
					<input type="text" placeholder="Write your message..." />
					<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
					<button type="button" class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php

$baseUrl = Yii::getAlias("@web");
$script = <<<JS

    function newMessage() {
      message = $(".message-input input").val();
      if ($.trim(message) == '') {
        return false;
      }
      $.ajax({
        url: "$baseUrl"+"/site/message",
        method:'POST',
        data:{
          message: message,
          action:"submit"
        },
        success: function(res){
          var data = JSON.parse(res);
          console.log(data);
					if(data['status'] == 'success'){
						$("#cart-quantity").text(data['totalCart']);
					}else{
						alter(data['message']);
					}
        },
        error: function(res){
          console.log(res);
        }

      });

      $('<li class="replies"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
      $('.message-input input').val(null);
      $('.contact.active .preview').html('<span>You: </span>' + message);
      $(".messages").animate({ scrollTop: $(document).height() }, "fast");
    };

		
    $('.submit').click(function () {
      newMessage();
    });

    $(window).on('keydown', function (e) {
      if (e.which == 13) {
        newMessage();
        return false;
      }
    });
JS;
$this->registerJs($script);
?>