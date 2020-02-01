      <?php
        if(isset($route)){
          switch ($route) {
            case 'inbox':
              include "mailbox/inbox.php";
            break;
          
          }
          switch ($route) {
            case 'read':
              include "mailbox/read-mail.php";
            break;
          
          }
          switch ($route) {
            case 'outbox':
              include "mailbox/outbox.php";
            break;
          
          }
          switch ($route) {
            case 'compose':
              include "mailbox/compose.php";
            break;
          
          }
        }

      ?>
    
  