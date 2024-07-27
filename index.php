<?php

include("database.php");
include("helper.php");

if (empty($_SESSION['login'])) {
  header("Location: login.php");
  die();
}


$sql = "SELECT u.id,u.name AS receiver_name,u.image FROM `messages` AS m
JOIN users AS u ON u.id = m.receiver_id
WHERE m.sender_id ='" . $_SESSION['user_id'] . "'";

$mysql_result =   mysqli_query($conn, $sql);

$thread = getData($mysql_result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat Box</title>

  <link rel="stylesheet" href="bootstrap.min.css">

  <style>
    .profile-img {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }

    ul li {
      cursor: pointer;
    }

    .send-box {
      padding: 0.8rem .75rem;
      background-color: #dee2e6;
      border-radius: 50px;
    }

    .form-control:focus {
      border-color: #86b7fe;
      outline: 0;
      box-shadow: 0 0 0 0 rgba(13, 110, 253, .25);
    }
  </style>
</head>

<body>

  <section>
    <div class="container mt-5">
      <div class="row justify-content-center">

        <div class="col-4 p-0">
          <div class="card rounded-0">
            <div class="bg-info-subtle card-header py-5 rounded-0">
              <div class="card-title mb-0 d-flex  justify-content-between align-items-center">

                <div class="align-items-sm-center d-sm-flex">
                  <img class="border me-3 profile-img rounded-5" src="img/<?= $_SESSION['user_image'] ?>" width="50" height="50">
                  <span> <?= $_SESSION['user_name'] ?? "" ?></span>
                </div>

                <a href="/logout.php"><i class="fa fa-edit"></i> Logout</a>

              </div>

            </div>

            <div class="card-body p-0">

              <ul class="list-unstyled overflow-y-scroll" style="min-height: 587px;max-height: 587px;">


                <?php

                $index = 1;

                if (empty($thread)) {
                  echo "<li>No Thread</li>";
                } else {

                  foreach ($thread as $key => $thrd) { ?>

                    <li class="border-bottom p-2">
                      <a href="javascript:void(0)" class="text-decoration-none text-black thread" <?= $thrd['id'] == 1 ? 'data-selected-thread="1" ' : ''  ?> data-thread-id="1" data-thread-name="<?= $thrd['receiver_name']  ?>" data-thread-image="<?= $thrd['image']  ?>">

                        <div class="align-items-sm-center d-sm-flex">
                          <img class="border me-3 profile-img rounded-5" src="img/<?= $thrd['image'] ?>" width="50" height="50">
                          <span><?= $thrd['receiver_name'] ?></span>
                        </div>
                      </a>
                    </li>

                <?php

                    $index++;
                  }
                }

                ?>


              </ul>

            </div>

          </div>
        </div>

        <div class="border-start-sm-0 col-8 p-0">
          <div class="border-start-0 card rounded-0">

            <div class="bg-transparent card-header py-3">
              <div class="card-title mb-0 d-flex  justify-content-between align-items-center">
                <div class="align-items-sm-center d-sm-flex participant_info">
                  <img class="border me-3 profile-img rounded-5" src="baijid.png" width="50" height="50">
                  <span> Baijid Hossain</span>
                </div>
              </div>
            </div>

            <div class="card-body p-0">

              <ul class="list-unstyled messages_list overflow-y-scroll" style="min-height: 584px; max-height: 587px;">

              </ul>

              <div class="d-flex gap-1 p-2">
                <input type="text" class="form-control send-box" id="message">
                <button class="btn bg-info-subtle rounded-3 send-message ">Send</button>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <script src="jquery-3.6.4.min.js"></script>


  <script>
    $(".thread").click(function() {

      var thread_id = $(this).data("thread-id");

      var thread_id = $(this).data("thread-id");

      var thread_name = $(this).data("thread-name");

      var thread_image = $(this).data("thread-image");


      $(this).data("thread-id");

      $(".thread").removeAttr('data-selected-thread')

      $(this).attr('data-selected-thread', thread_id)


      $(".participant_info").html(`
    
     <img class="border me-3 profile-img rounded-5" src="img/${thread_image}" width="50" height="50">
     <span> ${thread_name}</span>
    
    `)


      getMessages()

    })

    function participant_info() {

    }



    $(".send-message").click(function() {


      alert($(".thread").data("selected-thread").data('thread-name'))


      var message = $("#message").val();

      var thread_id = $(".thread").data("selected-thread");

      var user_id = <?= $_SESSION['user_id'] ?>

      $.ajax({
        url: "<?= $APP_URL  ?>/chatbox/message_send.php",
        method: "POST",
        data: {
          thread_id: thread_id,
          user_id: user_id,
          message: message
        },

        success: function(data) {

          console.log(data)

          $("#message").val("");

          getMessages(thread_id)
        }

      });



    })

    setInterval(function() {
      getMessages()
    }, 500)


    function getMessages() {

      var messages = "";
      var thread_id = $(".thread").data("selected-thread");

      $.ajax({
        url: "<?= $APP_URL  ?>/chatbox/get_message.php",
        method: "POST",
        data: {
          receiver_id: thread_id
        },
        success: function(data) {
          var get_messages = JSON.parse(data);
          get_messages.forEach(element => {

            if (element.sender_id == <?= $_SESSION['user_id'] ?>) {

              messages += `<li class="p-2 text-end">
            <small class="text-secondary"> 10:11 PM</small>
            <div class="d-flex justify-content-end">

              <div class="bg-info-subtle p-2 rounded-start-2 rounded-top-2  text-end">
                ${element.message}
              </div>
            </div>
          </li>`;
            } else {
              messages += `<li class=" p-2">
            <div class="d-flex">
              <img class="border me-3 profile-img rounded-5" src="img/${element.receiver_image}" width="50" height="50">
              <div>
                <span>${element.receiver_name}</span>
                <div class="bg-light p-2 rounded-bottom-3 rounded-end-2">${element.message}</div>
              </div>
            </div>

          </li>`;
            }


          });

          $(".messages_list").html(messages)

        }
      });
    }
  </script>

</body>

</html>