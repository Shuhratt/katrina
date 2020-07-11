
  $('#tabContainer').tabs({
    active: 0
  });

  $('#premium').click(function(){
      if ($(this).is(':checked')){
          $('#count').removeAttr('disabled');
      } else {
          $('#count').attr('disabled', 'disabled');
      }
  });

  $('#block').click(function(){
      if ($(this).is(':checked')){
          $('#images').attr('src', '../oc-content/themes/selena/admin/img/rightsidebar.png');
      } else {
          $('#images').attr('src', '../oc-content/themes/selena/admin/img/leftsidebar.png');
      }
  });
