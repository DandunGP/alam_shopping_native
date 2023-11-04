<?php 
    include 'layouts/header_chat.php';
?>
<!-- char-area -->
<section class="message-area">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="chat-area">
          <!-- chatbox -->
          <div class="chatbox showbox">
            <div class="modal-dialog-scrollable">
              <div class="modal-content">
                <div class="msg-head">
                  <div class="row">
                    <div class="col-8">
                      <div class="d-flex align-items-center">
                        <span class="chat-icon"><img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg" alt="image title"></span>
                        <div class="flex-grow-1 ms-3">
                          <h3>Chat Admin</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal-body">
                  <div class="msg-body">
                  <div id="chat">
                    <script>
                      if(x.length > 0){
                        <div>{x['text']}</div>
                      }
                      // else{
                      //   <div class="row">
                      //   <div class="col-md-12 ftco-animate">
                      //     <div class="alert alert-info">Tidak ada chat.Gunakanlah fitur chat ini untuk membantu permasalahan anda pada sistem kami</div>
                      //   </div>
                      // </div>
                      // }
                    </script>
                  </div>
                  </div>
                </div>
                
                <div class="send-box" id="chat-input">
                  <div class="input-container">
                    <input type="text" class="form-control" name="pesan" id="message" aria-label="pesan" placeholder="Ketikkan pesan..">
                  </div>
                    <button type="submit" id="send" name="kirim" style="float: right; margin-top:5px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Kirim</button>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- chatbox -->

      </div>
    </div>
  </div>
  </div>
</section>

<script>
let x = [];
$("#chat").html(x);
$(document).ready(function() {
    function getChat() {
        $.ajax({
            method: "GET",
            url: "function/chat_function.php",
            data: { action: 'get_chat' },
            success: function(data) {
                // $("#chat").html(data.data[0]['text']);
                $("#chat").html('');
                data.data.map(el => {
                  if(el['type'] == 'customer'){
                    $("#chat").append(`<ul>
                        <li class="repaly">
                          <p>${el['text']}</p>
                          <span class="time">${new Date(el['date']).getDate() + ' ' + new Date(el['date']).toLocaleString('en-US', { month: 'long' }) + ' ' + new Date(el['date']).getFullYear() + ' ' + new Date(el['date']).getHours() + ':' + new Date(el['date']).getMinutes() + ':' + new Date(el['date']).getSeconds()}</span>
                        </li>
                    </ul>`)
                  }else{
                    $("#chat").append(`<ul>
                        <li class="sender">
                          <p>${el['text']}</p>
                          <span class="time">${new Date(el['date']).getDate() + ' ' + new Date(el['date']).toLocaleString('en-US', { month: 'long' }) + ' ' + new Date(el['date']).getFullYear() + ' ' + new Date(el['date']).getHours() + ':' + new Date(el['date']).getMinutes() + ':' + new Date(el['date']).getSeconds()}</span>
                        </li>
                    </ul>`)
                  }
                });
            }
        });
    }

    getChat();

    $("#send").click(function() {
        var message = $("#message").val();

        $.ajax({
            method: "POST",
            url: "function/chat_function.php",
            data: { action: 'send_chat', text: message },
            success: function(res) {
                $("#message").val("");
                getChat();
            }
        });
    });

    setInterval(getChat, 1000);
});
</script>
<!-- char-area -->
<?php 
    include 'layouts/footer_chat.php';
?>