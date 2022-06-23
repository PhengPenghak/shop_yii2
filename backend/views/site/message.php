<div class="container">
  <div id="frame">
    <div id="sidepanel">
      <div id="profile">
        <div class="wrap">
          <img id="profile-img" src="http://emilcarlsson.se/assets/mikeross.png" class="online" alt="" />
          <p>Mike Ross</p>
          <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
          <div id="status-options">
            <ul>
              <li id="status-online" class="active"><span class="status-circle"></span>
                <p>Online</p>
              </li>
              <li id="status-away"><span class="status-circle"></span>
                <p>Away</p>
              </li>
              <li id="status-busy"><span class="status-circle"></span>
                <p>Busy</p>
              </li>
              <li id="status-offline"><span class="status-circle"></span>
                <p>Offline</p>
              </li>
            </ul>
          </div>
          <div id="expanded">
            <label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
            <input name="twitter" type="text" value="mikeross" />
            <label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
            <input name="twitter" type="text" value="ross81" />
            <label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
            <input name="twitter" type="text" value="mike.ross" />
          </div>
        </div>
      </div>
      <div id="search">
        <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
        <input type="text" placeholder="Search contacts..." />
      </div>
      <div id="contacts">
        <ul>
          <li class="contact">
            <div class="wrap">
              <span class="contact-status online"></span>
              <img src="http://emilcarlsson.se/assets/louislitt.png" alt="" />
              <div class="meta">
                <p class="name">Louis Litt</p>
                <p class="preview">You just got LITT up, Mike.</p>
              </div>
            </div>
          </li>
          <li class="contact active">
            <div class="wrap">
              <span class="contact-status busy"></span>
              <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
              <div class="meta">
                <p class="name">Harvey Specter</p>
                <p class="preview">Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or,
                  you do any one of a hundred and forty six other things.</p>
              </div>
            </div>
          </li>
          <li class="contact">
            <div class="wrap">
              <span class="contact-status away"></span>
              <img src="http://emilcarlsson.se/assets/rachelzane.png" alt="" />
              <div class="meta">
                <p class="name">Rachel Zane</p>
                <p class="preview">I was thinking that we could have chicken tonight, sounds good?</p>
              </div>
            </div>
          </li>
          <li class="contact">
            <div class="wrap">
              <span class="contact-status online"></span>
              <img src="http://emilcarlsson.se/assets/donnapaulsen.png" alt="" />
              <div class="meta">
                <p class="name">Donna Paulsen</p>
                <p class="preview">Mike, I know everything! I'm Donna..</p>
              </div>
            </div>
          </li>
          <li class="contact">
            <div class="wrap">
              <span class="contact-status busy"></span>
              <img src="http://emilcarlsson.se/assets/jessicapearson.png" alt="" />
              <div class="meta">
                <p class="name">Jessica Pearson</p>
                <p class="preview">Have you finished the draft on the Hinsenburg deal?</p>
              </div>
            </div>
          </li>
          <li class="contact">
            <div class="wrap">
              <span class="contact-status"></span>
              <img src="http://emilcarlsson.se/assets/haroldgunderson.png" alt="" />
              <div class="meta">
                <p class="name">Harold Gunderson</p>
                <p class="preview">Thanks Mike! :)</p>
              </div>
            </div>
          </li>
          <li class="contact">
            <div class="wrap">
              <span class="contact-status"></span>
              <img src="http://emilcarlsson.se/assets/danielhardman.png" alt="" />
              <div class="meta">
                <p class="name">Daniel Hardman</p>
                <p class="preview">We'll meet again, Mike. Tell Jessica I said 'Hi'.</p>
              </div>
            </div>
          </li>
          <li class="contact">
            <div class="wrap">
              <span class="contact-status busy"></span>
              <img src="http://emilcarlsson.se/assets/katrinabennett.png" alt="" />
              <div class="meta">
                <p class="name">Katrina Bennett</p>
                <p class="preview">I've sent you the files for the Garrett trial.</p>
              </div>
            </div>
          </li>
          <li class="contact">
            <div class="wrap">
              <span class="contact-status"></span>
              <img src="http://emilcarlsson.se/assets/charlesforstman.png" alt="" />
              <div class="meta">
                <p class="name">Charles Forstman</p>
                <p class="preview">Mike, this isn't over.</p>
              </div>
            </div>
          </li>
          <li class="contact">
            <div class="wrap">
              <span class="contact-status"></span>
              <img src="http://emilcarlsson.se/assets/jonathansidwell.png" alt="" />
              <div class="meta">
                <p class="name">Jonathan Sidwell</p>
                <p class="preview"><span>You:</span> That's bullshit. This deal is solid.</p>
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
        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
        <p>Harvey Specter</p>
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
                <li class="sent">
                  <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /></>
                  <p><?= $value->content ?></p>
                </li>

              <?php
              } else {
              ?>
                <li class="replies">
                  <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                  <p><?= $value->content ?></p>
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
        url: "$baseUrl"+"/index.php?r=site/message",
        method:'POST',
        data:{
          message: message,
          action:"submit"
        },
        success: function(res){
          var data = JSON.parse(res);
          console.log(data);
        },
        error: function(res){
          console.log(res);
        }
      });


      $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
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