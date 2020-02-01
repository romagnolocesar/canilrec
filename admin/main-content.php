<div id="dynamic-content-container">  
          <?php

            if(isset($page)){
              switch ($page) {
                case 'dashboard':
                  include "pages/dashboard.php";
                break;
              
              }
              switch ($page) {
                case 'manager-artists':
                  include "pages/managers/artistsManager.php";
                break;
              
              }
              switch ($page) {
                case 'manager-tracks':
                  include "pages/managers/tracksManager.php";
                break;
              
              }
              switch ($page) {
                case 'manager-genres':
                  include "pages/managers/genresManager.php";
                break;
              
              }
              switch ($page) {
                case 'manager-processmodules':
                  include "pages/managers/processModulesManager.php";
                break;
              
              }
              switch ($page) {
                case 'manager-ourservices':
                  include "pages/managers/ourServicesManager.php";
                break;
              
              }
              switch ($page) {
                case 'manager-scopes':
                  include "pages/managers/scopesManager.php";
                break;
              
              }
              switch ($page) {
                case 'manager-pages':
                  include "pages/managers/pagesManager.php";
                break;
              
              }
              switch ($page) {
                case 'manager-sections':
                  include "pages/managers/sectionsManager.php";
                break;
              
              }
              switch ($page) {
                case 'manager-users':
                  include "pages/managers/usersManager.php";
                break;
              
              }
              switch ($page) {
                case 'manager-usertypes':
                  include "pages/managers/usertypesManager.php";
                break;
              
              }
              switch ($page) {
                case 'mailbox-mailbox':
                  include "pages/mailbox.php";
                break;
              
              }
            }

          ?>


</div>
<!-- <div id="teste-chat" class="col-lg-3 col-md-3 col-sm-6">
  <?php 
  // include "blocks/chat/chat-box.php"; 
  ?>
</div> -->