
$(document).ready(function(){
    var page = 1;

    load_data(1,'');
    
    function load_data(page, keyword)
    {
      var brand = get_filter('brand');

      $.ajax({
        url:"../database/user/search.php",
        method:"POST",
        data:{page:page, keyword:keyword, brand:brand}, //this is what data send between hyperlink
        success:function(data)
        {
          $('#dynamic_content').html(data); //show in this dynaimic_content place
        }
      });
    }
    
    //click paginate & and current page
    // $(document).on('click', '.page-link', function(){
    //   var page = $(this).data('page_number');
    //   var keyword = $('#inputKeyword').val();
    //   load_data(page, keyword);
    // });
    
    //search only no use paginate
    $('#inputKeyword').keyup(function(){
      var keyword = $('#inputKeyword').val();
      load_data(1, keyword);  //set current is first page
    });



    window.onload = load_data(page, localStorage.getItem("temporayKeyword"));

    // var brandArray = [];
    // $("input:checkbox[name=type]:checked").each(function(){
    //   brandArray.push($(this).val());
    //   load_data(1, keyword, brandArray);  //set current is first page
    // });

    
    function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });

        return filter;
    }

    // $('.brand').click(function(){
    //     alert('hel');
    // });

    $.myjQuery = function() {
      var keyword = localStorage.getItem("temporayKeyword");
      load_data(1, keyword);

  };

});

  function chooseBrand(){
      $.myjQuery();
  }

// link
{/* <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script> */}
