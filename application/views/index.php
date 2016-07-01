<?php
  if (isset($_GET["page"])) {
    $page = $_GET["page"];
  } else {
    $page = 1;
  }
  $this->session->set_userdata('start', $page - 1);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Leads search and pagination</title>
  <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js'></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#name').focus();
      $.get('/ajaxs/index_html', function(res) {
        $('.body').html(res);
      });
      // $.get('/ajaxs/index_json', function(res) {
      //   $('.body').html(res);
      // }, 'json');
      $('#name').keyup(function() {
        console.log($('form').serialize());
        $.post($(this).parent().attr('action'), $('form').serialize(), function(res) {
          $('.body').html(res);
        });
        return false;
      });
      $(".body").on("click", ".pagination a", function(e){
    		e.preventDefault();
        var query = {};
        query.page_number = $(this).attr('data-page');
        query.name = $('#name').val();
        query.from_date = $('#from').val();
        query.to_date = $('#to').val();
        console.log(query);
        $.post($('form').attr('action'), query, function(res) {
          console.log($('form').attr('action'));
		      $(".body").html(res);
    		});
      });
      $('#from').change(function(){
        alert("from_date chosen");
        console.log($('form').serialize());
        $.post($(this).parent().attr('action'), $('form').serialize(), function(res) {
          $('.body').html(res);
        });
        return false;
      })
      $('#to').change(function(){
        alert("to_date chosen");
        console.log($('form').serialize());
        $.post($(this).parent().attr('action'), $('form').serialize(), function(res) {
          $('.body').html(res);
        });
        return false;
      })
    });
  </script>
  <style>
    .wrapper{
      width: 700px;
      margin: 20px auto;
      /*border: 1px solid black;*/
    }
    .search{
      margin: 0px;
    }
    .leads, .dates{
      display: inline-block;
      /*border: 1px solid silver;*/
    }
    .leads{
      width: 300px;
    }
    .dates{
      width: 390px;
      text-align: right;
    }
    .pagination{
      width: 700px;
      text-align: right;
    }
    table{
      width: 700px;
    }
    li{
      padding: 0px 10px;
      color: grey;
      display: inline-block;
      border-right: 1px solid grey;
    }
      li:last-child {
      border:none;
      }
    .display{
      margin-top: 20px;
    }
    .leads, .dates{
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class='wrapper'>
    <div class='search'>
      <form action='/ajaxs/search_query' method='post'>
        Name: <input id='name' type='name' name='name'>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        From: <input id='from' type='date' name='from_date'>&emsp;
        To: <input id='to' type='date' name='to_date'>
        <input type='hidden' name='page_number' value='<?php echo $page; ?>'>
      </form>
    </div>
    <div class='body'></div>
  </div>
</body>
</html>
