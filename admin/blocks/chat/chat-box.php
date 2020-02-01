<div class="row">
  <div class="col">
          <!-- DIRECT CHAT PRIMARY -->
          <div id="chat-container" class="box box-primary direct-chat direct-chat-primary 
          <?php 
            if(!isset($_SESSION['chatstates']['opened'])){
              echo ' collapsed-box';
            }else if($_SESSION['chatstates']['opened'] == 0){
              echo ' collapsed-box';
            }

            if(!isset($_SESSION['chatstates']['targetid'])){
              echo ' direct-chat-contacts-open';
            }

          ?>

          ">
            <div class="box-header with-border">
              <h3 class="box-title">Messenger - <span id="chatname"><?php 
                      if(isset($_SESSION['chatstates']['targetfullname'])){
                        $targetfullname= $_SESSION['chatstates']['targetfullname'];
                        echo utf8_decode($targetfullname);
                      }
                    ?></span></h3>

              <div class="box-tools pull-right">
                <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span> -->
                <button type="button" id="btnchatcollapse" class="btn btn-box-tool" data-widget="collapse">
                  <?php 
                    if(isset($_SESSION['chatstates']['opened'])){
                      if($_SESSION['chatstates']['opened'] == 1){
                        echo '<i class="fa fa-minus"></i>';
                      }else if($_SESSION['chatstates']['opened'] == 0){
                        echo '<i class="fa fa-plus"></i>';
                      }
                    }else{
                      echo '<i class="fa fa-plus"></i>';
                    }
                  ?>
                  
                </button>
                <button data-alert="false" type="button" id="btnopencontactlist" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                  <?php
                    $json_string = $GLOBALS['api']['chatusershasnewmessages']."/target/".$_SESSION['logged-user']->id;
                    $jsondata = file_get_contents($json_string);
                    $hasSomeNewMessagesItem = json_decode($jsondata, TRUE);
                    if($hasSomeNewMessagesItem){
                      echo '<i class="fa fa-comments" style="color: #DD4B39"></i></button>';
                    }else{
                      echo '<i class="fa fa-comments"></i></button>';
                    }
                  ?>
                  
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages" id="containerMessages" style="
              <?php 
                if(!isset($_SESSION['chatstates']['opened'])){
                  echo 'background-color: lightgray;';
                }else if($_SESSION['chatstates']['opened'] == 0){
                  echo 'background-color: lightgray;';
                }
              ?>
              ">

              </div>
              <!--/.direct-chat-messages-->

              <!-- Contacts are loaded here -->
              <div class="direct-chat-contacts">
                <?php
                  $json_string = $GLOBALS['api']['users'];  
                  $jsondata = file_get_contents($json_string);
                  $usersItens = json_decode($jsondata, TRUE);
                ?>
                <ul class="contacts-list">
                  <?php
                    foreach ($usersItens as $item) {
                      //Not show the current user in list, avoid self conversation
                      if($item['id'] != $_SESSION['logged-user']->id){
                        $json_string = $GLOBALS['api']['chatmessages']."/conversation/".$item['id']."/".$_SESSION['logged-user']->id; 
                        $jsondata = file_get_contents($json_string);
                        $messagesItens = json_decode($jsondata, TRUE);

                        $json_string = $GLOBALS['api']['chatusershasnewmessages']."/targetandcreator/".$_SESSION['logged-user']->id."/".$item['id'];
                        $jsondata = file_get_contents($json_string);
                        $hasNewMessagesItem = json_decode($jsondata, TRUE);

                        
                      
                  ?>
                      <li onclick="changeTargetChat(<?php echo $item['id']; ?>, '<?php echo utf8_decode($item['name'])." ".utf8_decode($item['lastname']); ?>')" class="contactsusers" data-id="<?php echo $item['id']; ?>" 
                        <?php 
                        if($hasNewMessagesItem){
                          echo "style='border-left: 0.5rem solid #00C0EF; background-color: #2c3d44'"; 
                        } 
                        ?>
                        >
                        <a href="#" >
                          

                          <?php
                            $currentDate = date_timestamp_get(new DateTime());
                            $minAllowedDateForOnlineUsers = date_timestamp_get(new DateTime())-600;
                            if($item['online'] >= $minAllowedDateForOnlineUsers){
                          ?>
                              <img class="contacts-list-img" src="<?php echo $GLOBALS['admin_base_url']."/img/users/".$item['picture']; ?>" alt="User Image" style="border: 0.2rem solid #00a65a">
                          <?php
                            }else{
                          ?>
                              <img class="contacts-list-img" src="<?php echo $GLOBALS['admin_base_url']."/img/users/".$item['picture']; ?>" alt="User Image" style="border: 0.2rem solid #656565">
                          <?php
                            }
                          ?>

                          <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  <?php echo utf8_decode($item['name'])." ".utf8_decode($item['lastname']); ?>
                                  <small class="contacts-list-date pull-right">
                                    <?php
                                    if(isset($messagesItens)){
                                      if(count($messagesItens)>0){
                                        if(isset($messagesItens[count($messagesItens)-1])){
                                          echo variant_date_from_timestamp($messagesItens[count($messagesItens)-1]['date']);
                                        }
                                      }
                                    }
                                    ?>
                                  </small>
                                </span>
                            <span class="contacts-list-msg">
                              <?php 
                              if(isset($messagesItens)){
                                if(count($messagesItens)>0){
                                  if(strlen($messagesItens[count($messagesItens)-1]['msg']) > 30){
                                    echo substr($messagesItens[count($messagesItens)-1]['msg'],0,30)."..."; 
                                  }else{
                                    echo $messagesItens[count($messagesItens)-1]['msg']; 
                                  }
                                }
                              }
                              ?>
                            </span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                  <?php
                    }
                  }
                  ?>
                  <!-- End Contact Item -->
                </ul>
                <!-- /.contatcts-list -->
              </div>
              <!-- /.direct-chat-pane -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <form role="form" id="dataform" method="post" enctype="multipart/form-data" action=''>
                <div class="input-group">
                  <input type="text" id="message" name="dataform[msg]" placeholder="Escrever mensagem..." class="form-control">
                  <input type="hidden" name="dataform[creator_user_id]" value="<?php echo utf8_decode($_SESSION['logged-user']->id); ?>">
                  <input type="hidden" name="dataform[target_user_id]" id="hidden_target_id"
                    <?php 
                      if(isset($_SESSION['chatstates']['targetid'])){
                        $targetid= $_SESSION['chatstates']['targetid'];
                        echo ' value="'.$targetid.'"';
                      }
                    ?>
                  >
                      <span class="input-group-btn">
                        <button id="chat-submit" type="" sesionName="<?php echo utf8_decode($_SESSION['logged-user']->id); ?>" class="btn btn-primary btn-flat 
                          <?php 
                            if(!isset($_SESSION['chatstates']['targetid'])){
                              echo ' disabled';
                            }
                          ?>
                          " userName="<?php echo utf8_decode($_SESSION['logged-user']->name)." ".utf8_decode($_SESSION['logged-user']->lastname); ?>">Enviar</button>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
        </div>
        <!-- /.col -->
</div>
            <!-- /.col -->